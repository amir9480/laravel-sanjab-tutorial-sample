<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'test');
set('default_timeout', 1200);
set('http_user', 'www-data');
set('writable_recursive', true);
set('writable_mode', 'chmod');

// Project repository
set('repository', 'https://github.com/amir9480/laravel-sanjab-tutorial-sample.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true);
set('branch', 'dev');

// Shared files/dirs between deploys
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server
add('writable_dirs', []);

// Hosts
host('amirtest.chickenkiller.com')
    ->user('root')
    ->port(2222)
    ->set('deploy_path', '/var/www/{{application}}');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

desc('Installing vendors');
task('deploy:vendors', function () {
    writeln('using custom installer');
    if (!commandExist('unzip')) {
        writeln('<comment>To speed up composer installation setup "unzip" command with PHP zip extension https://goo.gl/sxzFcD</comment>');
    }
    run('cd {{release_path}} && {{bin/composer}} {{composer_options}} || true');
});
