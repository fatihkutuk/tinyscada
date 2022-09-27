/*
  Modbus-Arduino Example - Test Led using callback (Modbus IP ESP8266/ESP32)
  Control a Led on D4 pin using Write Single Coil Modbus Function 
  Original library
  Copyright by André Sarmento Barbosa
  http://github.com/andresarmento/modbus-arduino

  Current version
  (c)2017 Alexander Emelianov (a.m.emelianov@gmail.com)
  https://github.com/emelianov/modbus-esp8266
*/

#ifdef ESP8266
 #include <ESP8266WiFi.h>
#else //ESP32
 #include <WiFi.h>
#endif
#include <ModbusIP_ESP8266.h>
#include "DHT.h"   
#include <Wire.h>
#include <Adafruit_BMP085.h>

#define seaLevelPressure_hPa 1013.25

Adafruit_BMP085 bmp;

const int LED_COIL = 100;
const uint16_t temprature = 200; // Sample Hreg

const uint16_t pressure = 202; // Sample Hreg

IPAddress ip(10, 10, 120, 168); 
IPAddress gateway(10,10,120,1); 
IPAddress subnet(255,255,255,0); 
//Used Pins
#ifdef ESP8266
 const int ledPin = D3; // Builtin ESP8266 LED
#else
 const int ledPin = TX; // ESP32 TX LED
#endif
//ModbusIP object
ModbusIP mb;

// Callback function for write (set) Coil. Returns value to store.
uint16_t cbLed(TRegister* reg, uint16_t val) {
  //Attach ledPin to LED_COIL register
  digitalWrite(ledPin, COIL_BOOL(val));
  return val;
}

// Callback function for client connect. Returns true to allow connection.
bool cbConn(IPAddress ip) {
  Serial.println(ip);
  return true;
}
 
void setup() {
  Serial.begin(115200);
  if (!bmp.begin()) {
  Serial.println("BMP180 Not Found. CHECK CIRCUIT!");
  
  }
 WiFi.config(ip,gateway,subnet);
  WiFi.begin("Koru1000", "envest9arge13");
  
  while (WiFi.status() != WL_CONNECTED) {
    delay(500);
    Serial.print(".");
  }
 
  Serial.println("");
  Serial.println("WiFi connected");  
  Serial.print("IP address: ");
  Serial.println(WiFi.localIP());
  
  mb.onConnect(cbConn);   // Add callback on connection event
  mb.server();

  pinMode(ledPin, OUTPUT);
  mb.addCoil(LED_COIL);       // Add Coil. The same as mb.addCoil(COIL_BASE, false, LEN)
  mb.addHreg(temprature,0);
  mb.addHreg(pressure,0);
  mb.onSetCoil(LED_COIL, cbLed); // Add callback on Coil LED_COIL value set

}

void loop() {
   
   int t = (int)(bmp.readTemperature()*100);
   int p = (int)(bmp.readAltitude(seaLevelPressure_hPa * 100));

   mb.Hreg(temprature,t);
   mb.Hreg(pressure,p);
   //Serial.println((float)bmp.readTemperature());
   //Serial.println((float)bmp.readPressure());
   mb.task();

   delay(10);
}
