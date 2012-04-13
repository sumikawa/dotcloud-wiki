all::
	@exit 0

push::
	dotcloud push --all wiki

logs::
	dotcloud logs wiki.wiki

ssh::
	dotcloud ssh wiki.wiki

restart::
	dotcloud restart wiki.wiki
