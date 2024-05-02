import requests
from bs4 import BeautifulSoup
import csv

def fetch_eon_data(eon_name):
    url = f"https://en.wikipedia.org/w/api.php?action=parse&format=json&page={eon_name}"

    response = requests.get(url)

    if response.status_code == 200:
        data = response.json()
        
        if 'error' in data:
            print("Page not found.")

        if 'parse' in data and 'text' in data['parse']:
            html_content = data['parse']['text']['*']
            soup = BeautifulSoup(html_content, 'html.parser')
            summary_paragraph = soup.find_all('p')
            
            if len(summary_paragraph) > 1:
                for sup in summary_paragraph[1].find_all('sup'):
                        sup.decompose()

                return summary_paragraph[1].text
    else:
        print("Failed to fetch data.")

    return "Desc not found."


csv_file_path = 'resources/csv/slider_data.csv'

with open(csv_file_path, 'r+', newline='', encoding='utf-8') as file:
    csv_reader = csv.reader(file)
    rows = list(csv_reader)

    eons = set()
    for row in rows[1:]:
        eons.add(row[0])

    eons = list(eons)

    eon_descriptions = []
    for eon_name in eons:
        eon_descriptions.append((eon_name, fetch_eon_data(eon_name)))

    descriptions_added = {eon: False for eon, _ in eon_descriptions} # mask for the first 'row[0] == eon' match

    for i, row in enumerate(rows[1:]):
        if not descriptions_added[row[0]]:
            for eon, description in eon_descriptions:
                print(row[0], eon)
                if row[0] == eon:
                    rows[i+1].append(description.strip()) # i+1 - header offset
                    descriptions_added[eon] = True
                    break
    
    rows[0].append('EonDescription')

    file.seek(0)
    writer = csv.writer(file)
    writer.writerows(rows)
    file.truncate()

print('fetch desc success')
