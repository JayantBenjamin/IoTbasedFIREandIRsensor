#include<ESP8266WiFi.h>
#include<WiFiClient.h>


const char ssid[]="your wifi name";
const char password[]="wifi password";
const char host[]="jayantbenjamin.000webhostapp.com";       //enter hosting domain name

IPAddress ip(192,168,0,1);  
IPAddress gatewayDNS(192,168,0,1); 
IPAddress netmask(255,255,255,0);

int val1,val2; //note valn is where the value of digital data gets stored from fire and ir 
int fire,ir;  // for future sending data to the backend/front end
String fires,irs,temps1,temps2;
float analog,temp1,temp2; //for temperature thing

/////connect to host variables
String line="";
String url="";

void setup() {
  // put your setup code here, to run once:
Serial.begin(115200);
pinMode(D0,OUTPUT); //for connecting to network  led
pinMode(D1,INPUT); //for fire sensor read
pinMode(D2,INPUT); //for ir sensor read

pinMode(D6,OUTPUT); //for temp sesnors
pinMode(D7,OUTPUT);


WiFi.begin(ssid,password);
while(WiFi.status()!=WL_CONNECTED)
{
  delay(500);
  Serial.print(".");
  digitalWrite(D0,LOW);
}
 Serial.println("Wifi connected to:");
 Serial.print(ssid);
 pinMode(D0,HIGH);


}

void loop() {
  // put your main code here, to run repeatedly:
  checkfire();
  delay(200);
  checkir();
  delay(200);
  checktemperature();
  delay(200);
  connecthost();
  delay(200);
}

void checkfire()
{
  Serial.println("Checking fire now");
  val1=digitalRead(D1);
  if(val1==1)
  {
    Serial.println("NO FIRE DETECTED");
    fire=0; 
  }
  else
  {
    Serial.println("FIRE DETECTED:");
    fire=1;
  }
  fires=String(fire);
}

void checkir()
{
  Serial.println("Checking ir now");
  val2=digitalRead(D2);
  if(val2==1)
  {
    Serial.println("NOTHING DETECTED");
    ir=0;
    irs="0";
  }
  else
  {
    Serial.println("SOMETHING DETECTED");
    ir=1;
    irs="1";
    }
    

}

void checktemperature()
{
  digitalWrite (D6,HIGH);
digitalWrite   (D7,LOW);
Serial.println ("TEMP Sensor 1 on");
analog=analogRead(A0);
temp1= analog*0.32265625;
Serial.println(temp1);
digitalWrite  (D6,LOW);
digitalWrite  (D7,HIGH);
Serial.println("TEMP Sensor 2 on");
analog= analogRead(A0);
temp2=analog*0.32265625;
Serial.println(temp2);
delay(500);
temps1=String(temp1);
temps2=String(temp2);
}
void connecthost()
{
  int counter,t1,t2;
  Serial.print("connecting to ");
  Serial.println(host);
  
  WiFiClient client; //Client to handle TCP Connection
  const int httpPort = 80;
  if (!client.connect(host, httpPort)) 
  { //Connect to server using port httpPort
    Serial.println("connection failed");
    //return;
    //digitalWrite(D7,HIGH);
  }

    url = "http://jayantbenjamin.000webhostapp.com/SIEShack/gethardwarerequest.php?p="+irs+"&t1="+temps1+"&t2="+temps2+"&f="+fires;

     Serial.println(url);
  client.print(String("GET ") + url + " HTTP/1.1\r\n" +
               "Host: " + host + "\r\n" +
               "Accept: */*"+"\r\n"+
               "Connection: close\r\n\r\n");
                t1=millis();
             
  unsigned long timeout = millis();
  while (client.available() == 0) {
    if (millis() - timeout > 25000) { //Try to fetch response for 25 seconds
      Serial.println(">>> Client Timeout !");
      client.stop();
      return;
    }
  }
  
  // Read all the lines of the reply from server and print them to Serial
//  counter=0;
  while(client.available())
  {
    
    // String line = client.readStringUntil('\r');
    
    char in1 = client.read();
    line+=in1;
    counter++;
//    led=true;
    Serial.print(in1);
    }
    //Serial.print(line);
    Serial.println("");
    Serial.println("********************************");
   //Serial.print(line);
  Serial.println();
  Serial.println("closing connection");
  client.stop(); //Close Connection
  t2=millis();
  t1=t2-t1;
  Serial.print("Time Taken ");
  Serial.println(t1/1000);
  Serial.print("Total String Length ");
  Serial.println(counter);
 
}

