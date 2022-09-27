
#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>
#include <WiFiClientSecure.h>
#include <ESP8266WebServer.h>
#include <ArduinoJson.h>
#include "DHT.h"   
 
#include <Adafruit_Sensor.h>
#define DHTTYPE DHT22


const char* ssid = "Koru1000";
const char* password = "envest9arge13";
String scada = "https://tinyscada.com/nodes/saveNodeValue";
String do1GetEndpoint = "https://tinyscada.com/nodes/tagsForWrite";

const int di1 = 5;
const int di2 = 4;
const int do1 = 0;
  
uint8_t DHTPin = D8;


DHT dht(DHTPin, DHTTYPE);
float t = 0.0;
float h = 0.0;
ESP8266WebServer server(5002);
int chipid = ESP.getChipId();
unsigned long lastTime = 0;
unsigned long timerDelay = 5000;
String page = "";


String ipToString(IPAddress ip){
  String s="";
  for (int i=0; i<4; i++)
    s += i  ? "." + String(ip[i]) : String(ip[i]);
  return s;
}
void sendData(){
     h = dht.readHumidity();
     t = dht.readTemperature(); 
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
  Serial.println("CPU ID: "+chipid);
  Serial.println("di1 : "+String(digitalRead(di1))+" di2 : "+String(digitalRead(di2))+" do2 : "+String(digitalRead(do1))+" nem : "+String(h)+" sicaklik : "+String(t));
  server.handleClient();
  sendData();
  getDo1();
  delay(100);
}
