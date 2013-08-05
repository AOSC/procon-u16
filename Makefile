
REMOTE_CONFIG = .secret/config.remote.json
REMOTE_PORT = 2222
REMOTE_PATH = $(shell cat .secret/remote_path.txt)

test:
	@casperjs test casper-tests/form.js

publish:
	@cat $(REMOTE_CONFIG) > config.json
	rsync -avCz -e 'ssh -p $(REMOTE_PORT)' --delete \
    --exclude='.DS_Store' \
    --exclude='*.log' \
    --exclude='*.zip' \
    . $(REMOTE_PATH)
	@git checkout config.json

.PHONY: publish