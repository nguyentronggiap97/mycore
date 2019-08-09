.PHONY: vendor

# Build path to resource
dir ?= $(shell pwd)
date ?= ${shell date +'%Y-%m-%d %H:%M:%S'}
port ?= 8000

help:
	@echo "> Commands"
	@echo "--------------------------------------"
	@echo "  make build 		-- Build service"
	@echo "  make clean 		-- Clean binary"
	@echo "  make update 		-- Update cores latest version"
	@echo "  make deploy 		-- Deploy to google cloud server"

info: ps
	@echo ""
	@echo "> Demen backend project: backend"
	@echo "--------------------------------------"
	git status

init:
	@echo ""
	@echo "> Initialize project git config"
	@echo "--------------------------------------"
	git config user.name "Truong Dinh Ngoc"
	git config user.email ngoctd.ws@gmail.com
	git config core.fileMode false

dev: clean
	@echo ""
	@echo "> Start laravel server http://id.demenbooks.com"
	@echo "--------------------------------------"
	@php artisan serve --port=${port}

run: dev

release:
	@echo ""
	@echo "> Release backend project"
	@echo "--------------------------------------"
	@echo "Please reference to https://deployer.org/"

build:
	@echo ""
	@echo "> Install vendor"
	@echo "--------------------------------------"
	@composer install

deploy:
	@echo ""
	@echo "> Deploy application to remote"
	@echo "--------------------------------------"
	@echo "Please reference to https://deployer.org/"

autoload:
	@echo ""
	@echo "> Refresh laravel autoload"
	@echo "--------------------------------------"
	composer dump-autoload

clean:
	@echo ""
	@echo "> Clean laravel cached"
	@echo "--------------------------------------"
	php artisan cache:clear
	php artisan config:clear
	php artisan route:cache
	php artisan view:clear

composer:
	@echo ""
	@echo "> Update composer"
	@echo "--------------------------------------"
	@composer update

tuning:
	@echo ""
	@echo "> Tuning laravel performance"
	@echo "--------------------------------------"
	php artisan config:cache
	php artisan route:cache
	php artisan optimize

route:
	@echo ""
	@echo "> List laravel routes"
	@echo "--------------------------------------"
	php artisan route:list

seed:
	@echo ""
	@echo "> Generate seed database"
	@echo "--------------------------------------"
	php artisan db:seed --class=CategorySeeder
	php artisan db:seed --class=RoleSeeder
	php artisan db:seed --class=PublisherSeeder
	php artisan db:seed --class=SchoolSeeder
	php artisan db:seed --class=ClassroomSeeder
	# php artisan db:seed --class=UserSeeder
	# php artisan db:seed --class=ProductSeeder
	# php artisan db:seed --class=OrderSeeder
	# php artisan db:seed --class=SettingSeeder
