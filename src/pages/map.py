import folium
#import webbrowser


def ler_coordenadas(arquivo):
    coordenadas = []
    with open(arquivo, 'r') as f:
        for linha in f:
            linha = linha.strip()
            if linha:
                lat, lon = map(float, linha.split(','))
                coordenadas.append((lat, lon))
    return coordenadas


arquivo_coordenadas = "cordenadasmatinha.txt"
CoordGeo = ler_coordenadas(arquivo_coordenadas)

mapa = folium.Map(location=(-18.750639739234646, -47.50921854640424), zoom_start=16)

# add vetor
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

arquivo_html = "meu_mapa.html"

mapa.save(arquivo_html)

