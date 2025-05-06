import folium
import psycopg2


def ler_coordenadas(arquivo):
    coordenadas = []
    with open(arquivo, 'r') as f:
        for linha in f:
            linha = linha.strip()
            if linha:
                lat, lon = map(float, linha.split(','))
                coordenadas.append((lat, lon))
    return coordenadas

##############################################

def obter_nascentes_do_banco():
    try:
        conexao = psycopg2.connect(
            dbname='teste',
            user='teste',
            password='123',
            host='localhost',
            port='5432'
        )
        cursor = conexao.cursor()
        cursor.execute("SELECT nome, latitude, longitude, qualidade_agua, vazao, descricao FROM nascente")
        resultados = cursor.fetchall()
        return resultados
    except Exception as e:
        print("Erro ao conectar ao banco:", e)
        return []
    finally:
        if 'conexao' in locals():
            conexao.close()

##############################################

def obter_flora_do_banco():
    try:
        conexao = psycopg2.connect(
            dbname='teste',
            user='teste',
            password='123',
            host='localhost',
            port='5432'
        )
        cursor = conexao.cursor()
        cursor.execute("SELECT nomec, nomep, latitude, longitude, estado, descricao FROM flora")
        resultados = cursor.fetchall()
        return resultados
    except Exception as e:
        print("Erro ao conectar ao banco (fauna):", e)
        return []
    finally:
        if 'conexao' in locals():
            conexao.close()

##############################################

def obter_fauna_do_banco():
    try:
        conexao = psycopg2.connect(
            dbname='teste',
            user='teste',
            password='123',
            host='localhost',
            port='5432'
        )
        cursor = conexao.cursor()
        cursor.execute("SELECT especie, grupo, latitude, longitude, descricao FROM fauna")
        resultados = cursor.fetchall()
        return resultados
    except Exception as e:
        print("Erro ao conectar ao banco (fauna):", e)
        return []
    finally:
        if 'conexao' in locals():
            conexao.close()


arquivo_coordenadas = "cordenadasmatinha.txt"
CoordGeo = ler_coordenadas(arquivo_coordenadas)

mapa = folium.Map(location=(-18.750639739234646, -47.50921854640424), zoom_start=16)

folium.Polygon(
    locations=CoordGeo,
    color='blue',
    weight=4,
    fill_color='green',
    fill_opacity=0.4,
    fill=True,
    popup='Região demarcada',
    tooltip='Clique para detalhes',
).add_to(mapa)

##############################################
nascentes = obter_nascentes_do_banco()
for nascente in nascentes:
    nome, lat, lon, qualidade, vazao, descricao = nascente
    popup_text = f"<b>Nome:</b> {nome}<br><b>Qualidade da Água:</b> {qualidade}<br><b>Vazão:</b> {vazao}<br><b>Latitude:</b> {lat}<br><b>Longitude:</b> {lon}<br><b>Descrição:</b> {descricao}<br>"
    folium.Marker(
        location=[float(lat), float(lon)],
        popup=folium.Popup(popup_text, max_width=300),
        icon=folium.Icon(color='blue', icon='tint', prefix='fa'),
        tooltip=nome
    ).add_to(mapa)

######################################33
flora = obter_flora_do_banco()
for i in flora:
    nomec, nomep, lat, lon, estado, descricao = i
    popup_text = f"<b>Nome Cientifico:</b> {nomec}<br><b>Nome Popular:</b> {nomep}<br><b>Latitude:</b> {lat}<br><b>Longitude:</b> {lon}<br><b>Estado:</b> {estado}<br><b>Descrição:</b> {descricao}<br>"
    folium.Marker(
        location=[float(lat), float(lon)],
        popup=folium.Popup(popup_text, max_width=300),
        icon=folium.Icon(color='green', icon='leaf', prefix='fa'),
        tooltip=nomep
    ).add_to(mapa)
##########################################
fauna = obter_fauna_do_banco()
for animal in fauna:
    especie, grupo, lat, lon, descricao = animal
    popup_text = f"<b>Espécie:</b> {especie}<br><b>Grupo:</b> {grupo}<br><b>Latitude:</b> {lat}<br><b>Longitude:</b> {lon}<br><b>Descrição:</b> {descricao}<br>"
    folium.Marker(
        location=[float(lat), float(lon)],
        popup=folium.Popup(popup_text, max_width=300),
        icon=folium.Icon(color='orange', icon='paw', prefix='fa'),
        tooltip=especie
    ).add_to(mapa)

arquivo_html = "meu_mapa.html"
mapa.save(arquivo_html)
