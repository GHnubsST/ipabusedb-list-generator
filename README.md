# ipabusedb-list-generator
 Scripts for ipabusedb list generator
You will need to register at ipabusedb to get a API key
On the Mikrotik v6 setup a scheduler with 
/tool fetch check-certificate=no  mode=https http-method=get url=https://api.urbanwave.co.za/mikrotik-v6-ipabusedb.rsc; /import file="mikrotik-v6-ipabusedb.rsc";
On the Mikrotik v7 setup a scheduler with
/tool/fetch check-certificate=no  mode=https http-method=get url=https://api.urbanwave.co.za/mikrotik-v7-ipabusedb.rsc; /import file="mikrotik-v7-ipabusedb.rsc";
 
