import csv
import numpy as np
import random

table = ["usuario (`nome`, `genero`, `email`, `nascimento`, `senha`, `celular`, `foto`)",
		"preferencias (descricao)",
		"usuario_preferencias (email, id)",
		"grupo (nome, categoria, email_criador)",
		"carona (email, origem, destino, descricao, data, hora, qtd_passageiros, bagagem, preco",
		"veiculo (modelo, conforto, categoria, cor, email_dono)",
		"info_modelo (modelo, marca, lugares)",
		"mensagem (email_destinatario, email_remetente, conteudo, status)",
		"reserva (email, id_carona)",
		"amizade (email_amigo1, email_amigo2)",
		"avalia (email_avaliado, email_avaliador, nota, conteudo, data)",
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
		for x in range(700):
			string = ''
			for y in range(4):
				string += '"' + str(matrix[x,y]) + '", '
			string = string[:-2]
			f.write("INSERT INTO " + table + " VALUES (" + string + ");\n" )
			

# nomes = getData('usuarios-data/name.csv')
# nomes = np.array(nomes)
# nomes = np.asmatrix(nomes)
# fotos = getData('usuarios-data/picture.csv')
# fotos = np.array(fotos)
# fotos = np.asmatrix(fotos)
# fotos = np.delete(fotos, [1,2], 1)

dados = getData('usuarios-data/data(1).csv')
dados = np.array(dados)

dados2 = getData('usuarios-data/data(2).csv')
dados2 = np.array(dados2)

dados3 = getData('usuarios-data/data(3).csv')
dados3 = np.array(dados3)

dados4 = getData('usuarios-data/data(4).csv')
dados4 = np.array(dados4)

dados = np.concatenate((dados,dados2,dados3,dados4), axis = 0)

# full = np.c_[nomes, dados, fotos]
# print full
# toSQL(full, 'final/usuario.sql', table[0]);
email1 = []
email2 = []
email = dados[:,1]
emailb = email[0:175]
emaila = email[0:400]
for k in range(0,175):
	email1.append(emailb[k])
	email2.append(emaila[k+100])
	email1.append(emailb[k])
	email2.append(emaila[k+101])
	email1.append(emailb[k])
	email2.append(emaila[k+102])
	email1.append(emailb[k])
	email2.append(emaila[k+103])
email1 = np.array(email1)
email2 = np.array(email2)

avalia = getData('msgavalia-data/msg(1).csv')
avalia = np.array(avalia)
avalia2 = getData('msgavalia-data/msg(2).csv')
avalia2 = np.array(avalia2)
avalia3 = getData('msgavalia-data/msg(3).csv')
avalia3 = np.array(avalia3)
avalia4 = getData('msgavalia-data/msg(4).csv')
avalia4 = np.array(avalia4)
avalia5 = getData('msgavalia-data/msg(5).csv')
avalia5 = np.array(avalia5)
avalia6 = getData('msgavalia-data/msg(6).csv')
avalia6 = np.array(avalia6)
avalia7 = getData('msgavalia-data/msg(7).csv')
avalia7 = np.array(avalia7)

avalia = np.concatenate((avalia,avalia2,avalia3,avalia4,avalia5,avalia6,avalia7), axis = 0)

full = np.c_[email1, email2, avalia]
toSQL(full, 'final/mensagem.sql', table[7])
#email = np.concatenate((email, email, email, email, email), axis = 0)


# origem = getData('cidades/cidade.csv')
# origem = np.array(origem)
# destino = getData('cidades/cidade2.csv')
# destino = np.array(destino)

# dias = getData('cidades/dias(1).csv')
# dias = np.array(dias)

# dias2 = getData('cidades/dias(2).csv')
# dias2 = np.array(dias2)

# dias3 = getData('cidades/dias(3).csv')
# dias3 = np.array(dias3)

# dias4 = getData('cidades/dias(4).csv')
# dias4 = np.array(dias4)

# dias5 = getData('cidades/dias(5).csv')
# dias5 = np.array(dias5)

# dias = np.concatenate((dias,dias2,dias3,dias4,dias5), axis = 0)

# descricao = [0 for x in range(500)]
# for x in range(500)
# 	descricao[x] = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ultrices, sapien non ornare dignissim, nisl urna maximus felis, et convallis sem odio sed libero. Vivamus auctor enim et ipsum varius hendrerit. Duis faucibus blandit dictum. Nam placerat urna eget hendrerit vestibulum. Sed odio odio, venenatis sit amet orci vel, sollicitudin varius diam. Praesent efficitur mauris quis massa cursus, at malesuada ligula ultricies. Vestibulum molestie dignissim ultrices. Donec et varius enim. Suspendisse potenti."

# full = np.c_[email, origem, destino, descricao, dias]
# print full
# toSQL(usu_pref, 'caronas.sql', table[4])

# k = 0
# usu_pref = [[0 for x in range(2)] for y in range(1600)]
# for x in range(400):
# 	flag1 = True
# 	flag2 = True
# 	flag3 = True
# 	for y in range (4):
# 		usu_pref[k][0] = email[x]
# 		if (flag1 == True and flag2 == True and flag3 == True):
# 			usu_pref[k][1] = random.randint(1,3)
# 			flag1 = False
# 		elif (flag1 == False and flag2 == True and flag3 == True):
# 			usu_pref[k][1] = random.randint(4,6)
# 			flag2 = False
# 		elif (flag1 == False and flag2 == False and flag3 == True):
# 			usu_pref[k][1] = random.randint(7,9)
# 			flag3 = False
# 		else:
# 			usu_pref[k][1] = random.randint(10,12)
# 		k = k + 1
# 		#usu_pref[x] = 1 + y
# 		#usu_pref[x] = 2 + y
# 		#usu_pref[x] = 3 + y

# print len(usu_pref)
# toSQL(usu_pref, 'usu_pref.sql', table[2])


# modelo = getData('modelo.csv')
# modelo = np.array(modelo)
# modelo = modelo[0:200]
# modelo = np.asmatrix(modelo)
# dados = getData('veiculo-data/data(1).csv')
# dados = np.array(dados)

# dados2 = getData('veiculo-data/data(2).csv')
# dados2 = np.array(dados2)

# dados = np.concatenate((dados,dados2), axis = 0)

# #print dados.shape, modelo.shape, email.shape
# full = np.c_[modelo, dados, email]
# print full	
# toSQL(full, 'final/veiculos.sql', table[5])


# grupo = getData('grupo-data/data(1).csv')
# grupo = np.array(grupo)

# participa = getData('grupo-data/participa(1).csv')
# participa = np.array(participa)
# participa2 = getData('grupo-data/participa(2).csv')
# participa2 = np.array(participa2)
# participa3 = getData('grupo-data/participa(3).csv')
# participa3 = np.array(participa3)
# participa = np.concatenate((participa,participa3,participa2), axis = 0)


# full = np.c_[email, participa]
# print full
# toSQL(full, 'final/participa.sql', table[11])