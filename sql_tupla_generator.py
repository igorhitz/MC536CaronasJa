import csv

# Get data from csv
def getData(file):
	with open(file, 'rb') as file:
		reader = csv.reader(f)
		data = list(reader)

# Transform list of elements in insert commands
def toSQL(list, file):
	with open(file, 'w') as file:
		for x in list:
			file.write("INSERT INTO usuarios (email, nome, senha, foto, genero, nascimento, celular) VALUES (" + x + ')' );
