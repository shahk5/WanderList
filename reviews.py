# We import the requests module which allows us to make the API call
#! /usr/bin/python3
import json
import requests
import mysql.connector
import argparse
import urllib
import sys
import pprint

from urllib.error import HTTPError
from urllib.parse import quote
from urllib.parse import urlencode

#use authentication code as app_secret
app_secret = 'DbcVh6n74NPHG_3-QvbS_HEHzcacvIfZTPlsV4UdL8QA6gULwLU34PFLtA6FSr90ubQ30hB8FZdzdBNAvug22H5P703sX-kGNyD_atIoFvi1N64Jyhzmux2ThFW1W3Yx'

response_data = ''
loaded_data = []

API_HOST = 'https://api.yelp.com'
SEARCH_PATH = '/v3/businesses/search'
BUSINESS_PATH = '/v3/businesses/'


location = input("Enter Zip Code: ")
search_limit = 1

def request(host, path, api_key, url_params=None):
    url_params = url_params or {}
    url = '{0}{1}'.format(host, quote(path.encode('utf8')))
    headers = {
        'Authorization': 'Bearer %s' % app_secret,
    }

    print(u'Querying {0} ...'.format(url))

    response = requests.request('GET', url, headers=headers, params=url_params)
    return response.json()
    
    

def search(app_secret, location):
    """Query the Search API by a search term and location.
    Args:
        term (str): The search term passed to the API.
        location (str): The search location passed to the API.
    Returns:
        dict: The JSON response from the request.
    """

    url_params = {
        'location': location.replace(' ', '+'),
        'limit': search_limit
    }
    return request(API_HOST, SEARCH_PATH, app_secret, url_params=url_params)


def get_business(app_secret, business_id):
    """Query the Business API by a business ID.
    Args:
        business_id (str): The ID of the business to query.
    Returns:
        dict: The JSON response from the request.
    """
    business_path = BUSINESS_PATH + business_id

    return request(API_HOST, business_path, app_secret)

def get_reviews(app_secret, business_id):
    business_path = BUSINESS_PATH + business_id + "/reviews"
    return request(API_HOST, business_path, app_secret)


def query_api(location):
    """Queries the API by the input values from the user.
    Args:
        term (str): The search term to query.
        location (str): The location of the business to query.
    """
    response = search(app_secret, location)

    businesses = response.get('businesses')

    if not businesses:
        print(u'No businesses for {0} in {1} found.'.format(location))
        return

    business_id = businesses[0]['id']

    print(u'{0} businesses found, querying business info ' \
        'for the top result "{1}" ...'.format(
            len(businesses), business_id))
    response = get_business(app_secret, business_id)

    print (get_reviews(app_secret, business_id))

    print(u'Result for business "{0}" found:'.format(business_id))
    
    response_data = response
    data = json.dumps(response_data)
    loaded_data = json.loads(data)
    bus_name = str(loaded_data['name'])


    response1 = get_reviews(app_secret, business_id)
    review_data = response1
    reviews = json.dumps(review_data)
    loaded_reviews = json.loads(reviews)

    for i in loaded_reviews['reviews']:
        
        user_rating = str(i['rating'])
        text = str(i['text'])
        user = str(i['user'])
        
        print (bus_name + " ... adding to DB. ")

        conn = mysql.connector.connect(user='root', password = '', host ='localhost', database ='yelp')

        cursor = conn.cursor()

        myquery = ("INSERT INTO reviews " "(bus_name, rating, text)" "VALUES (%s ,%s,%s)", (bus_name, user_rating, text))

        cursor.execute(*myquery)
        conn.commit()
        print ("added.")
        
        
    cursor.close()
    conn.close()
    

def main():
    parser = argparse.ArgumentParser()

    parser.add_argument('-l', '--location', dest='location',
                        default = location, type=str,
                        help='Search location (default: %(default)s)')

    input_values = parser.parse_args()

    try:
        query_api(input_values.location)
    except HTTPError as error:
        sys.exit(
            'Encountered HTTP error {0} on {1}:\n {2}\nAbort program.'.format(
                error.code,
                error.url,
                error.read(),
            )
        )


if __name__ == '__main__':
    main()