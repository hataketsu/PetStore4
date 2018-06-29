#!/usr/bin/env bash
cd diagrams
find ./ -name \*.puml |xargs -I{} sh -c 'plantuml $1 -o ~/Desktop/image/`dirname $1`' -- {}
