#!/bin/sh

trap "exit 1" USR1
PROC="$$"

fatal(){
	echo "$@" >&2
	kill -10 $PROC
}

grep -rl '\(^#!\/bin\/.\+sh\)\|\(^#!\/usr\/bin\)' . --exclude-dir=vendor --exclude-dir=node_modules --exclude-dir=local --exclude-dir=.git | while IFS= read -r file
do
	fatal "Error in ${file}: please only use #!/bin/sh shebang"
done

grep -rl '^#!\/bin\/sh' . --exclude-dir=vendor --exclude-dir=node_modules --exclude-dir=local --exclude-dir=.git | while IFS= read -r file
do
	echo "Checking ${file}"
	if ! shellcheck "$file"; then
		fatal "Shellcheck error in ${file}"
		exit 1
	fi
done

echo OK
