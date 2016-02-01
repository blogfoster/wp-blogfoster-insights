#!/usr/bin/env make

zip:
	./buildscripts/zip.sh

lint:
	./buildscripts/lint.sh

.PHONY: zip lint
