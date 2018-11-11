set :stages,        %w(staging)
set :default_stage, "staging"
set :stage_dir,     "app/config"
require 'capistrano/ext/multistage'

set :parameters_dir, "app/config"
set :parameters_file, false
set :console_dir, "app"
set :console_file, false

task :upload_parameters do
  origin_file = parameters_dir + "/" + parameters_file if parameters_dir && parameters_file
  if origin_file && File.exists?(origin_file)
    ext = File.extname(parameters_file)
    relative_path = "app/config/parameters" + ext

    if shared_files && shared_files.include?(relative_path)
      destination_file = shared_path + "/" + relative_path
    else
      destination_file = latest_release + "/" + relative_path
    end
    try_sudo "mkdir -p #{File.dirname(destination_file)}"

    top.upload(origin_file, destination_file)
  end
end

task :upload_console do
  origin_file = console_dir + "/" + console_file if console_dir && console_file
  if origin_file && File.exists?(origin_file)
    relative_path = "app/console"

    if shared_files && shared_files.include?(relative_path)
      destination_file = shared_path + "/" + relative_path
    else
      destination_file = latest_release + "/" + relative_path
    end
    try_sudo "mkdir -p #{File.dirname(destination_file)}"

    top.upload(origin_file, destination_file)
  end
end

task :write_cache do
    run "chmod -R 777 #{latest_release}/#{cache_path}"
end

task :restart_php_fpm do
    run "sudo /usr/sbin/service php5-fpm restart"
end
