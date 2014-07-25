import xml.etree.ElementTree as ET

path = '/Applications/MAMP/htdocs/Arb/data'
file = path + '/ArbTrailsNumbered.xml'

out = open(path + '/ArbTrailsNumbered.csv', 'w')

out.write('id,latitude,longitude,trail\n')

tree = ET.parse(file)
root = tree.getroot()

i = 1

for point in root.iter('rtept'):
    out.write(str(i) + ',' + point.attrib['lat'] + ',' + point.attrib['lon'] + ',' + point.attrib['trail'] + '\n')
    i = i+1


out.close()
