import BeautifulSoup
tei = open('BX8558.SGM').read()
soup = BeautifulSoup.BeautifulSoup(tei)

#print(soup.prettify())
#print(soup.get_text())
tag = soup.p
print(tag)
