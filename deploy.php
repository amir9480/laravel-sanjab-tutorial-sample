<?php
namespace Deployer;

require 'recipe/laravel.php';

set('application', 'test');
set('default_timeout', 1200);
set('http_user', 'laradock');
set('writable_recursive', true);
set('writable_mode', 'chown');
set('keep_releases', 2);

set('repository', 'https://github.com/amir9480/laravel-sanjab-tutorial-sample.git');

set('git_tty', true);
set('branch', 'dev');

add('shared_files', []);
add('shared_dirs', []);

add('writable_dirs', []);

host('amirtest.chickenkiller.com')
    ->user('root')
    ->port(2222)
    ->set('deploy_path', '/var/www/{{application}}');

after('deploy:failed', 'deploy:unlock');

before('deploy:symlink', 'artisan:migrate');

desc('Installing vendors');
task('deploy:vendors', function () {
    writeln('using custom installer');
    run('cd {{release_path}} && {{bin/composer}} {{composer_options}} || true');
});
