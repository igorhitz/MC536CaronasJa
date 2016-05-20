import csv
import numpy as np

table = ["usuarios (genero, nome, email, senha, celular, foto, nascimento)",
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
	with open(file, 'rb') as f:
		reader = csv.reader(f)
		data = list(reader)
	return data

# Transform matrix of elements in insert commands
def toSQL(matrix, file, table):
	with open(file, 'w') as f:
		for x in range(80):
			string = ''
			for y in range(7):
				string += str(matrix[x,y]) + ', '
			string = string[:-2]
			f.write("INSERT INTO " + table + " VALUES (" + string + ")\n" )
			
# Fix usuarios.csv
def usuariosTransform():
	data = getData('usuarios.csv')
	data = np.array(data)
	data = np.asmatrix(data)
	data = np.delete(data, 0, 0) # header 
	data = np.delete(data, [1,3,5,7,8,9,10,13,14], 1) # removendo colunas inuteis
	for x in range(0, np.size(data.T[0])):
		if data[x,0] == 'male':
			data[x,0] = 'M'
		data[x,0] = 'F'
	dias =  ['1976-09-18', '1977-01-30', '1978-02-04', '1978-09-08', '1979-04-04', '1979-05-11', '1979-10-28', '1980-02-10', '1982-02-06', '1982-10-10', '1983-01-08', 
			'1983-03-14', '1984-08-18', '1986-02-07', '1986-12-25', '1989-03-03', '1989-11-06', '1989-11-24', '1990-01-29', '1994-04-04', '1995-07-07', '1997-04-13', 
			'1997-11-09', '1998-05-07', '1999-01-08','1978-11-28', '1979-01-09','1979-06-11','1980-06-07', '1980-11-13', '1982-03-10','1983-01-02','1983-03-14','1983-10-13','1985-03-27','1985-08-03','1988-06-27',
			'1989-01-25','1989-02-24','1989-03-29','1989-10-13','1990-04-08','1995-08-07','1996-09-03','1998-05-02','1998-12-12','1999-08-29','1999-12-23','2000-04-23',
			'2000-05-12','1975-08-21','1975-12-05','1976-01-19','1976-06-18','1979-07-14','1980-11-07','1981-05-30','1981-11-03','1982-04-30','1983-12-29','1986-05-01','1988-09-04',
			'1990-05-24','1992-09-16','1992-09-22','1993-09-07','1994-04-24','1995-08-21','1995-12-14','1996-01-01','1996-07-11','1997-09-14','1998-04-17','1998-06-14','1999-10-08',
			'1975-06-09','1976-06-23','1976-10-04','1978-09-21','1981-05-23']
	dias = np.array(dias)
	data = np.c_[ data, dias ]
	toSQL(data, 'usuarios.sql', table[0])
	
print ("iniciando...")
usuariosTransform()