
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClientSecure.h>
#include <ESP8266WebServer.h>

#include "DHT.h"   


const char* ssid = "fatihktk";
const char* password = "fthktk179";
String server = "https://tinyscada.com/nodes/saveNodeValue";

const int di1 = 5;
const int di2 = 4;
const int do1 = 0;

#define DHTPIN 2
#define DHTTYPE DHT11 
DHT dht(DHTPIN, DHTTYPE); 

unsigned long lastTime = 0;
unsigned long timerDelay = 5000;

int chipid = ESP.getChipId();
String ipToString(IPAddress ip){
  String s="";
  for (int i=0; i<4; i++)
    s += i  ? "." + String(ip[i]) : String(ip[i]);
  return s;
}
void sendData(){
  if(digitalRead(do1)==1){
    digitalWrite(do1,LOW);
  }else{
    digitalWrite(do1,HIGH);
  }
    float h = dht.readHumidity() >= 0 ? dht.readHumidity() : 0;
    float t = dht.readTemperature() >= 0 ? dht.readTemperature() : 0; 
    if(WiFi.status()== WL_CONNECTED){
      WiFiClientSecure   client;
      HTTPClient http;
      client.setInsecure();
      http.begin(client,server);
      http.addHeader("Content-Type", "application/x-www-form-urlencoded");
      String httpRequestData = "localip="+ipToString(WiFi.localIP())+"&serialNumber="+chipid+"&di1="+digitalRead(di1)+"&di2="+digitalRead(di1)+"&do1="+digitalRead(do1)+"&sicaklik="+t+"&nem="+h+"";           
      int httpResponseCode = http.POST(httpRequestData);
      Serial.println(httpRequestData);
      Serial.print("HTTP Response code is: ");
      Serial.println(httpResponseCode);
      http.end();
    }
    else {
      Serial.println("WiFi Disconnected");
    }
}
void setup() {

  pinMode(di1,INPUT);
  pinMode(di2,INPUT);
  pinMode(do1,OUTPUT);

  Serial.begin(115200); 
  WiFi.begin(ssid, password);
  Serial.println("Connecting");
  while(WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.print("Connected to WiFi network with IP Address: ");
  Serial.println(WiFi.localIP());
  Serial.println(chipid);
  Serial.println(digitalRead(di1));


}

void loop() {

    sendData();
    delay(1000);

}
