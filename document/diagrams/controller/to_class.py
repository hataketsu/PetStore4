import sys
text=sys.argv[1]

text=text.strip()
text=text.replace('{','')
text=text.replace('.php:',"{\n")
text=text.replace('public function','+')
text='class '+text +'\n}'

print(text)