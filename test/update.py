import requests
import json
import time
from twilio.rest import Client
import pymysql

def sendMessageAlerts(updates):
	account_sid = "ACb81ba4bdda2e8a23f2d56bcb40df44c7"
	auth_token  = "dc7551d98daf3dae4e861b671f6964ab"
	client = Client(account_sid, auth_token)

	for update in updates:
		town, location = update
		conn = pymysql.connect(host='localhost', user='mybcabus',password='mybcabus',db='mybcabus')
		cur = conn.cursor()
		cur.execute("select town, number from user where town = %s", town)
		for town, number in cur.fetchall():
			print(number)
			message = client.messages.create(
		    to=str(number), 
		    from_="+16282222870",
		    body="The bus to " + town + " has arrived and is at spot " + location + "!")

def getTownLocations():
	sheet = json.loads(requests.get('https://spreadsheets.google.com/feeds/list/1S5v7kTbSiqV8GottWVi5tzpqLdTrEgWEY4ND4zvyV3o/od6/public/values?alt=json').text)

	townLocations = list()

	#town is really 2
	for town in sheet['feed']['entry']:
		townName = ""
		location = ""
		if 'gsx$townsbuslocation' in town:
			townName = town['gsx$townsbuslocation']['$t']
		if 'gsx$_cokwr' in town:
			location = town['gsx$_cokwr']['$t']

		townLocations.append((townName, location))

		townName = ""
		location = ""
		if 'gsx$townsbuslocation_2' in town:
			townName = town['gsx$townsbuslocation_2']['$t']
		if 'gsx$_cre1l' in town:
			location = town['gsx$_cre1l']['$t']

		townLocations.append((townName, location))

	return townLocations

def diffTownLocation(tl1, tl2):
	diff = list()
	for x in range(len(tl1)):
		if ((tl1[x][1] != tl2[x][1]) and tl2[x][1] != ""):
			diff.append(tl2[x])
	return diff


townLocations1 = getTownLocations()
updates = list()
while True:
	time.sleep(5)
	townLocations2 = getTownLocations()
	diff = diffTownLocation(townLocations1, townLocations2)
	print(list(set(diff) - set(updates)))
	sendMessageAlerts(list(set(diff) - set(updates)))
	updates += list(set(diff) - set(updates))
