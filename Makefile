#!/usr/bin/env make

zip:
	zip -r blogfoster-insights.zip ./blogfoster-insights

lint:
	./build/lint.sh

.PHONY: zip
