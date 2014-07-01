import xml.etree.ElementTree as ET

path = '/Users/rlundquist3/Dropbox/2013-2014/ArbApp/Data/ArbTrails/TrailsGPX'
file = path + '/ArbTrails.xml'

out = open(path + '/ArbTrails.csv', 'w')

out.write('id,latitude,longitude\n')

tree = ET.parse(file)
root = tree.getroot()

i = 1

for point in root.iter('rtept'):
    out.write(str(i) + ',' + point.attrib['lat'] + ',' + point.attrib['lon'] + '\n')
    i = i+1

out.close()
