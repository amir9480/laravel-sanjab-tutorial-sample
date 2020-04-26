<?php
namespace Deployer;

require 'recipe/laravel.php';

set('application', 'test');
set('default_timeout', 1200);
set('http_user', 'laradock');
set('writable_recursive', true);
set('writable_mode', 'chown');
set('keep_releases', 3);

set('repository', 'https://github.com/amir9480/laravel-sanjab-tutorial-sample.git');

set('git_tty', true);
set('branch', 'dev');

add('shared_files', []);
add('shared_dirs', []);

add('writable_dirs', []);

host('docker')
    ->hostName('amirtest.chickenkiller.com')
    ->user('laradock')
    ->port(2222)
    ->set('deploy_path', '/var/www/{{application}}');

after('deploy:failed', 'deploy:unlock');

before('deploy:symlink', 'artisan:migrate');

desc('Installing vendors');
task('deploy:vendors', function () {
    writeln('using custom installer');
    run('cd {{release_path}} && {{bin/composer}} {{composer_options}} || true');
})->onHosts('docker');

desc('Restart PHP-FPM');
task('deploy:restart-phpfpm', function () {
    on(host('server')
        ->hostName('amirtest.chickenkiller.com')
        ->user('ubuntu'),
        function () {
            writeln('Restarting PHP-FPM');
            run('cd laradock && docker-compose restart php-fpm');
            writeln('Restarted PHP-FPM');
        });
});

after('deploy:symlink', 'artisan:cache:clear');
after('deploy:symlink', 'deploy:restart-phpfpm');
