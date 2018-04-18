#!/bin/bash
#
# Note: the themes come in as a separate github repo.
# This is fine, but it's not possible to push changes upstream - the
# subrepo is strictly read-only. This avoids any nonsense related to git 
# subtrees / submodules.

rm -rf theme-machine
git clone https://github.com/HackerThemes/theme-machine.git
