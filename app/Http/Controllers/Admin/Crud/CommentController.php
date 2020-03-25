<?php

namespace App\Http\Controllers\Admin\Crud;

use App\Comment;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Sanjab\Cards\StatsCard;
use Sanjab\Controllers\CrudController;
use Sanjab\Helpers\Action;
use Sanjab\Helpers\CrudProperties;
use Sanjab\Helpers\FilterOption;
use Sanjab\Helpers\MaterialIcons;
use Sanjab\Widgets\CheckboxWidget;
use Sanjab\Widgets\IdWidget;
use Sanjab\Widgets\Relation\BelongsToPickerWidget;
use Sanjab\Widgets\TextWidget;

class CommentController extends CrudController
{
    protected static function properties(): CrudProperties
    {
        return CrudProperties::create('comments')
                ->model(\App\Comment::class)
                ->title("نظر")
                ->titles("نظرات")
                ->icon(MaterialIcons::CHAT)
                ->creatable(false)
                ->badge(function () {
                    return Comment::withoutGlobalScope('approved')->where('approved', false)->count();
                });
    }

    protected function init(string $type, Model $item = null): void
    {
        $this->widgets[] = IdWidget::create();

        $this->widgets[] = CheckboxWidget::create('approved', 'تایید')
                            ->fastChange(true);

        $this->widgets[] = BelongsToPickerWidget::create('user', 'کاربر')
                            ->format('%id - %first_name %last_name')
                            ->onEdit(false)
                            ->ajax(true);

        $this->widgets[] = BelongsToPickerWidget::create('product', 'محصول')
                            ->format('%id - %name')
                            ->onEdit(false)
                            ->ajax(true);

        $this->widgets[] = BelongsToPickerWidget::create('replyTo', 'جواب به')
                            ->format('%id')
                            ->onEdit(false);

        $this->widgets[] = TextWidget::create('text', 'متن')
                            ->onEdit(false);

        array_unshift(
            $this->actions,
            Action::create('پاسخ')
                ->icon(MaterialIcons::CHAT)
                ->perItem(true)
                ->action('replyComment')
                ->confirmInput('text')
                ->confirmInputTitle('متن پاسخ')
                ->confirm('پاسخ به نظر')
                ->variant('warning')
                ->authorize(function ($item) {
                    return $item->reply_id == null;
                })
        );

        $this->cards[] = StatsCard::create('نظرات تایید نشده')
                        ->value(Comment::withoutGlobalScope('approved')->where('approved', false)->count())
                        ->icon(MaterialIcons::CHAT)
                        ->variant('danger');

        $this->filters[] = FilterOption::create('نظرات تایید نشده')
                            ->query(function ($query) {
                                $query->where('approved', false);
                            });

        $this->filters[] = FilterOption::create('نظرات تایید شده')
                            ->query(function ($query) {
                                $query->where('approved', true);
                            });
    }

    public function replyComment(Request $request, Comment $comment)
    {
        $comment->approved = true;
        $comment->save();
        $reply = $comment->replies()->make(['user_id' => Auth::id(), 'product_id' => $comment->product_id, 'text' => $request->input('input')]);
        $reply->approved = true;
        $reply->save();
        return ['success' => true];
    }

    protected function queryScope(Builder $query)
    {
        $query->withoutGlobalScope('approved');
    }
}
