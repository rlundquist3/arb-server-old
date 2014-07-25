import xml.etree.ElementTree as ET

path = '/Applications/MAMP/htdocs/Arb/data'
file = path + '/ArbTrails.xml'

#out = open(path + '/ArbTrailsNumbered.xml', 'w')

#out.write('id,latitude,longitude\n')

tree = ET.parse(file)
root = tree.getroot()

i = 1

'''for point in root.iter('rtept'):
    out.write(str(i) + ',' + point.attrib['lat'] + ',' + point.attrib['lon'] + '\n')
    i = i+1
'''

for trail in root.iter('rte'):
    for point in trail.iter('rtept'):
        point.set('trail', str(i))
    i = i+1

tree.write(path + '/ArbTrailsNumbered.xml')

#out.close()
