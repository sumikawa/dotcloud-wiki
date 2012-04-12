all::
	@exit 0

push::
	dotcloud push --all sumikawa

logs::
	dotcloud logs sumikawa.wiki

ssh::
	dotcloud ssh sumikawa.wiki

restart::
	dotcloud restart sumikawa.wiki
