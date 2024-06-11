import json
fichier_json="test.json"
def prout(fichier):
    with open(fichier) as tamere:
       data = json.load(tamere)
    print(data)
    return data
def dicotest(jsoncoucou):
    for key, values in jsoncoucou.items():
        print(f"clé : {key}")
        print(f"contenue : {values}")
        for i in values:
            for key2, values2 in i.items():
                print(f"clé : {key2}")
                print(f"contenue : {values2}")
test=prout(fichier_json)
dicotest(test)