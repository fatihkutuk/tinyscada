
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClientSecure.h>
#include <ESP8266WebServer.h>
#include <ArduinoJson.h>
#include "DHT.h"   


const char* ssid = "Koru1000";
const char* password = "envest9arge13";
String scada = "https://tinyscada.com/nodes/saveNodeValue";
String do1GetEndpoint = "https://tinyscada.com/nodes/tagsForWrite";
const int di1 = 5; //d1
const int di2 = 4; //d2
const int do1 = 0; //d3

#define DHTPIN 2 // d4

#define DHTTYPE DHT11 
DHT dht(DHTPIN, DHTTYPE); 
ESP8266WebServer server(5002);

String page = "";
int chipid = ESP.getChipId();
String ipToString(IPAddress ip){
  String s="";
  for (int i=0; i<4; i++)
    s += i  ? "." + String(ip[i]) : String(ip[i]);
  return s;
}
void sendData(){

    float h = dht.readHumidity();
    float t = dht.readTemperature(); 
    if(WiFi.status()== WL_CONNECTED){
      WiFiClientSecure   client;
      HTTPClient http;
      client.setInsecure();
      http.begin(client,scada);
      http.addHeader("Content-Type", "application/x-www-form-urlencoded");      
      int httpResponseCode = http.POST("localip="+ipToString(WiFi.localIP())+"&serialNumber="+chipid+"&di1="+digitalRead(di1)+"&di2="+digitalRead(di2)+"&do1="+digitalRead(do1)+"&sicaklik="+t+"&nem="+h+"");
      Serial.print("Okuma İsteği İçin Http Cevabı: ");
      Serial.println(httpResponseCode);
      http.end();
    }
    else {
      Serial.println("WiFi Bağlantısı Yok");
    }
}
void getDo1(){
     if(WiFi.status()== WL_CONNECTED){
      StaticJsonBuffer<200> jsonBuffer;
      WiFiClientSecure   client;
      HTTPClient http;
      client.setInsecure();
      
      http.begin(client,do1GetEndpoint);
      http.addHeader("Content-Type", "application/x-www-form-urlencoded");             
      http.POST("serialNumber="+String(chipid)+"&tagName=do1");
      Serial.println("Yazma İsteği İçin Http Ceevabı : "+http.getString());
      JsonObject& root = jsonBuffer.parseObject(http.getString());
      if(http.getString()!="false"){
         digitalWrite(do1,(int)root["tagValue"]);
      }
      http.end();    
    }
    else {
      Serial.println("WiFi Bağlantısı Yok");
   }
}
void setup() {
    
  page = "<h1>Simple NodeMCU Web Server</h1><p><a href=\"LEDOn\"><button>ON</button></a>&nbsp;<a href=\"LEDOff\"><button>OFF</button></a></p>";
  server.on("/", [](){
    server.send(200, "text/html", page);
  });
   server.on("/LEDOn", [](){
    digitalWrite(do1,HIGH);
    server.send(200, "text/html", page);
  });
   server.on("/LEDOff", [](){
    digitalWrite(do1,LOW);
    server.send(200, "text/html", page);
  });
  server.begin();


  pinMode(di1,INPUT);
  pinMode(di2,INPUT);
  pinMode(do1,OUTPUT);

  Serial.begin(115200); 
  WiFi.begin(ssid, password);
  Serial.println("Bağlanıyor Lütfen Bekleyiniz..");
  while(WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
  Serial.println("");
  Serial.print("Wifi Bağlantısı Başarılı. Local IP : ");
  Serial.println(WiFi.localIP());
  Serial.println("CPU ID: "+chipid);

}

void loop() {
  Serial.println(ESP.getChipId());
  Serial.println("di1 : "+String(digitalRead(di1))+" di2 : "+String(digitalRead(di2))+" do2 : "+String(digitalRead(do1))+" nem : "+String(dht.readHumidity())+" sicaklik : "+String(dht.readTemperature()));
  server.handleClient();
  sendData();
  getDo1();
  delay(2000);
}
