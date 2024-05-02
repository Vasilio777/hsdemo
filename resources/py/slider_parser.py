from bs4 import BeautifulSoup
import csv

with open('resources/py/parser_data.html', 'r', encoding='utf-8') as file:
    html_content = file.read()

soup = BeautifulSoup(html_content, 'html.parser')

table = soup.find("table", class_="waffle").find('tbody')
num_rows = len(table.find_all('tr'))
num_columns = len(table.find('tr').find_all('td'))
data = [[None] * num_columns for _ in range(num_rows)]

for i, row in enumerate(table.find_all('tr')):
    j = 0
    columns = row.find_all('td')
    for col in columns:
        text = col.text.strip()
        rowspan = int(col.get('rowspan', 1))
        colspan = int(col.get('colspan', 1))

        while j < num_columns and data[i][j] is not None:
            j += 1

        for rspan in range(rowspan):
            for cspan in range(colspan):
                if i + rspan < num_rows and j + cspan < num_columns:
                    data[i + rspan][j + cspan] = text

        j += colspan

data[-1][-1] = 0.1
data[-1][-2] = float(data[-2][-2]) + float(data[-1][-1]) 

with open('resources/csv/slider_data.csv', 'w', newline='', encoding='utf-8') as file:
    writer = csv.writer(file)
    writer.writerows(data)

print('parser success')

# add fetch_eon_ desc in a row.. later
 