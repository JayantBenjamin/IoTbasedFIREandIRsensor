#include <ESP8266WiFi.h>
#include<WiFiClient.h>

const char ssid[]="your wifi name";
const char password[]="wifi password";
const char host[]="jayantbenjamin.000webhostapp.com"; //if we are using url later why here

int i=0,a=0;
boolean state=false; 
//int  b[5]={3,3,3,3,3};
int nik[5]={3,3,3,3,3};
//don't know why

String line=""; //found use nowhere
WiFiClient client; // ?
IPAddress ip(192,168,0,1);  //?
IPAddress gatewayDNS(192,168,0,1);//?
IPAddress netmask(255,255,255,0);//?

void setup(){
  pinMode(D0,OUTPUT);
  pinMode(D1,OUTPUT);
  pinMode(D2,OUTPUT);
  pinMode(D5,OUTPUT);
  digitalWrite(D0,LOW);
  digitalWrite(D1,LOW);
  digitalWrite(D2,LOW);
  digitalWrite(D5,LOW);
  Serial.begin(115200);
  Serial.println("*******");
  Serial.println("begin");
  Serial.println("connecting to WiFi");
  WiFi.mode(WIFI_STA);
  WiFi.begin(ssid,password);
  while(WiFi.status()!=WL_CONNECTED)
  {
    delay(300);
    Serial.print(".");
  }
  if(WiFi.status()==WL_CONNECTED)
  {
    Serial.print(ssid);
    Serial.println("connected");
  }
}

void loop(){
    line="";
    i=0;
    for(a=0;a<5;a++)
      {
        nik[a]=3;
      }

     delay(500);
    Serial.print("connecting to");
    Serial.println(host);
    WiFiClient client ;
    const int httpPort=80;
    if(!client.connect(host,httpPort))
    {
    Serial.println("connection failed");
  }



String url="http://jayantbenjamin.000webhostapp.com/SIEShack/view.php";
client.print(String("GET ") + url + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" +
               "Accept: */*"+"\r\n"+
               "Connection: close\r\n\r\n");
//client.print(String("GET") +url+"HTTP/1.1\r\n" + "Host: "+ host + "\r\n"+ "Accept:*/*"+"\r\n"+"Connection:close\r\n\r\n");
unsigned long timeout = millis();
  while (client.available() == 0) {
    if (millis() - timeout > 5000) { //Try to fetch response for 25 seconds
      Serial.println(">>> Client Timeout !");
      client.stop();
      return;
    }
  }
  

while(client.available())
{ 
  Serial.print("");
  char in1=client.read();
  line+=in1;
  Serial.print(in1);
}
  //Serial.println("");
  Serial.println("*********");
  Serial.print(line);
  Serial.println();
  Serial.println("closing connection");
  client.stop();
  state=false;
  while(state==false)
{
  //Serial.println("Mei hu while ke andar");
  if(line[i]=='z')
  {
    state=true;
    Serial.println("NASTY:");
    Serial.println(i);
    i++;
    int b=0;
    
    for( b=i;b<=i+4;b++)
    {
      
      nik[b-i]=line[b]-'0';
    }
  }
  else
  {
    i++;
  }
}

for(int j=0;j<4;j++)
{
  Serial.print(nik[j]);
  Serial.print(" ");
  Serial.println(j);
}

if(nik[0]==0)
{
  digitalWrite(D0,LOW);
}
else if(nik[0]==1)
{
  digitalWrite(D0,HIGH);
}
if(nik[1]==0)
{
  digitalWrite(D1,LOW);
}
if(nik[1]==1)
{
  digitalWrite(D1,HIGH);
}
if(nik[2]==0)
{
  digitalWrite(D2,LOW);
}
if(nik[2]==1)
{
  digitalWrite(D2,HIGH);
}
if(nik[3]==0)
{
  digitalWrite(D5,LOW);
}
if(nik[3]==1)
{
  digitalWrite(D5,HIGH);
}

}


