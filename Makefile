.PHONY: help build up down restart logs shell db-shell composer npm artisan migrate seed fresh test

# Default target
help: ## Show this help message
	@echo 'Usage: make [target]'
	@echo ''
	@echo 'Targets:'
	@awk 'BEGIN {FS = ":.*?## "} /^[a-zA-Z_-]+:.*?## / {printf "  \033[36m%-15s\033[0m %s\n", $$1, $$2}' $(MAKEFILE_LIST)

# Production commands
build: ## Build production containers
	docker-compose build --no-cache

up: ## Start production containers
	docker-compose up -d

down: ## Stop production containers
	docker-compose down

restart: ## Restart production containers
	docker-compose restart

logs: ## Show production logs
	docker-compose logs -f

# Development commands
dev-build: ## Build development containers
	docker-compose -f docker-compose.dev.yml build --no-cache

dev-up: ## Start development containers
	docker-compose -f docker-compose.dev.yml up -d

dev-down: ## Stop development containers
	docker-compose -f docker-compose.dev.yml down

dev-restart: ## Restart development containers
	docker-compose -f docker-compose.dev.yml restart

dev-logs: ## Show development logs
	docker-compose -f docker-compose.dev.yml logs -f

# Application commands
shell: ## Access application shell
	docker-compose exec app sh

db-shell: ## Access database shell
	docker-compose exec db mysql -u pengaduan_user -p pengaduan_db

composer: ## Run composer install
	docker-compose exec app composer install

npm: ## Run npm install
	docker-compose exec app npm install

artisan: ## Run artisan command (usage: make artisan cmd="migrate")
	docker-compose exec app php artisan $(cmd)

migrate: ## Run database migrations
	docker-compose exec app php artisan migrate

seed: ## Run database seeders
	docker-compose exec app php artisan db:seed

fresh: ## Fresh migration with seed
	docker-compose exec app php artisan migrate:fresh --seed

test: ## Run tests
	docker-compose exec app php artisan test

# Cache commands
cache-clear: ## Clear all caches
	docker-compose exec app php artisan cache:clear
	docker-compose exec app php artisan config:clear
	docker-compose exec app php artisan route:clear
	docker-compose exec app php artisan view:clear

cache-optimize: ## Optimize caches for production
	docker-compose exec app php artisan config:cache
	docker-compose exec app php artisan route:cache
	docker-compose exec app php artisan view:cache

# Note: Database backup/restore not available for external PostgreSQL
# Use your PostgreSQL provider's backup tools (e.g., Supabase dashboard)

# Monitoring
stats: ## Show container stats
	docker stats

ps: ## Show running containers
	docker-compose ps

# Cleanup
clean: ## Clean up unused Docker resources
	docker system prune -f
	docker volume prune -f

clean-all: ## Clean up all Docker resources (WARNING: This will remove all containers, images, and volumes)
	docker system prune -a -f
	docker volume prune -f

# Setup commands
setup: ## Initial setup for development
	make dev-build
	make dev-up
	sleep 30
	make composer
	make migrate
	make seed
	@echo "Development environment is ready!"
	@echo "Application: http://localhost:8000"
	@echo "phpMyAdmin: http://localhost:8081"

setup-prod: ## Initial setup for production
	make build
	make up
	sleep 30
	make migrate
	make cache-optimize
	@echo "Production environment is ready!"
	@echo "Application: http://localhost"
	@echo "phpMyAdmin: http://localhost:8080"