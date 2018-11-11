set :application, "Aldebaran"
set :domain,      "grupocazaperu.com"
set :deploy_to,   "/home/grupoca7/public_html/aldebaran"
set :app_path,    "var"

set :repository,  "git@bitbucket.org:jafeth_bendezu_d4m/aldebaran.git"
set :scm,         :git
set :branch,      "master"
set :deploy_via,  :remote_cache
# Or: `accurev`, `bzr`, `cvs`, `darcs`, `subversion`, `mercurial`, `perforce`, or `none`

ssh_options[:forward_agent] = true
ssh_options[:keys] = [File.join(ENV["HOME"], ".ssh", "d4m_aws.pub")]

set :user, "grupoca7"
set :use_sudo, false
set :default_run_options, {:pty => true}

set :use_composer,   true
set :update_vendors, false
set :cache_warmup,  false
set :composer_options,  "--no-dev --verbose --prefer-dist --optimize-autoloader --no-progress "

# Assets install
set :assets_install,      true
set :assets_symlinks,     true
set :assets_relative,     false
set :dump_assetic_assets, true

set :webserver_user,    "appuser"
set :permission_method,   :chmod
set :use_set_permissions, false

set :shared_files,      ["app/config/parameters.yml"]
set :shared_children,   [app_path + "/logs", web_path + "/uploads", "vendor", "data"]
set :writable_dirs,     ["var/cache", "var/logs"]


set :model_manager, "doctrine"
# Or: `propel`

role :web,        domain                         # Your HTTP server, Apache/etc
role :app,        domain, :primary => true       # This may be the same as your `Web` server

set  :keep_releases,  3

# Be more verbose by uncommenting the following line
logger.level = Logger::MAX_LEVEL
#after "deploy:update_code", "upload_parameters"
after "deploy:finalize_update", "write_cache"