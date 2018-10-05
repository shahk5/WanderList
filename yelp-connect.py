# Import the requests module which allows us to make the API call
import requests
#use authentication code as app_secret
app_secret = 'DbcVh6n74NPHG_3-QvbS_HEHzcacvIfZTPlsV4UdL8QA6gULwLU34PFLtA6FSr90ubQ30hB8FZdzdBNAvug22H5P703sX-kGNyD_atIoFvi1N64Jyhzmux2ThFW1W3Yx'

#To Authorize use a header with authentication code as bearer.
headers = {'Authorization': 'bearer %s' % app_secret}

# Call Yelp API to pull info from local bakery
biz_id = 'kizbees-kitchen-egg-harbor-city'
url = 'https://api.yelp.com/v3/businesses/%s' % biz_id
response = requests.get(url=url, headers=headers)
response_data = response.json()

print(response_data)
