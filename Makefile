COMPOSE=docker-compose
APP=$(COMPOSE) exec php
COMPOSER=$(COMPOSE) run --rm composer
CONSOLE=$(APP) bin/console

.PHONY: help install build start stop deps deps_php

help:
	@fgrep -h "##" $(MAKEFILE_LIST) | fgrep -v fgrep | sed -e 's/\\$$//' | sed -e 's/##//'

install:
install: build start deps db_schema_update dashboard_import_cities

build:
	$(COMPOSE) build

start:
	$(COMPOSE) up -d

stop:
	$(COMPOSE) stop

deps:  ## Install dependencies
deps: deps_php

deps_php: ## Install PHP dependencies
	$(COMPOSER) install

test:
	$(COMPOSE) exec -T php phpunit

db_schema_update:
	$(CONSOLE) doctrine:schema:update --force

db_entities_generate:
	$(CONSOLE) doctrine:generate:entities AloeDev --no-backup

dashboard_import_cities:
	$(CONSOLE) dashboard:import-cities
