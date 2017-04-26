COMPOSE=docker-compose
APP=$(COMPOSE) exec php
COMPOSER=$(COMPOSE) run --rm composer
CONSOLE=$(APP) bin/console

.PHONY: help install build start deps deps_php

help:
	@fgrep -h "##" $(MAKEFILE_LIST) | fgrep -v fgrep | sed -e 's/\\$$//' | sed -e 's/##//'

install:
install: build start deps

build:
	$(COMPOSE) build

start:
	$(COMPOSE) up -d

deps:  ## Install dependencies
deps: deps_php

deps_php: ## Install PHP dependencies
	$(COMPOSER) install
