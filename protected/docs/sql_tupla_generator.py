import csv

table = ["usuarios (email, senha, foto, nome, genero, nascimento, celular)",
		"preferencias (descricao)",
		"usuario_preferencias (email, id)",
		"grupo (nome, categoria, email_criador)",
		"carona (email, id_grupo, origem, destino, descricao, data, hora, qtd_passageiros, bagagem, preco",
		"veiculo (modelo, conforto, categoria, cor, email_dono)",
		"info_modelo (modelo, marca, lugares)",
		"mensagem (email_destinatario, email_remetente, conteudo, status, data)",
		"reserva (email, id_carona)",
		"amizade (email_amigo1, email_amigo2, data_inicio)",
		"avalia (email_avaliador, email_avaliado, data, nota, conteudo)",
		"participa (email, id_grupo)"]

# Get data from csv
def getData(file):
	with open(file, 'rb') as file:
		reader = csv.reader(f)
		data = list(reader)
	return data

# Transform list of elements in insert commands
def toSQL(list, file, table):
	with open(file, 'w') as file:
		for x in data:
			file.write("INSERT INTO " + table + " VALUES (" + x + ")\n" );

data = getData('usuarios.csv')
toSql(data, 'usuarios.sql', table[0])