#include "DHT.h"
#include <ArduinoJson.h>
#define DHTPIN 8
#define DHTTYPE DHT22 
const int moistPin = A3;
const int ldrPin = A0;
const int fanPin =3;
const int relayLightPin =2;
const int relayPumpPin =11;
DHT dht(DHTPIN, DHTTYPE);
float humid = 0;
float temp = 0;
float mositure= 0;
float light = 0; 
void setup() {
pinMode(fanPin,OUTPUT);
pinMode(relayLightPin,OUTPUT);
pinMode(relayPumpPin,OUTPUT);
pinMode(moistPin,INPUT);
pinMode(ldrPin, INPUT);
Serial.begin(9600);
dht.begin();
}
 
void loop() {
   delay(2000);
 readTemp();
 readMoist();
 readLight();
 StaticJsonBuffer<1000> jsonBuffer;
 JsonObject& root = jsonBuffer.createObject();
  root["humid"] = humid;
  root["temp"] = temp;
  root["moisture"] = mositure;
  root["light"] = light;
  //printResult();
if(Serial.available()>0)
{
 root.printTo(Serial);

}
delay(1000);
}
void printResult()
{
   Serial.print("Humidity: "); 
  Serial.print(humid);
  Serial.print(" %\t");
  Serial.print("Temperature: "); 
  Serial.print(temp);
  Serial.print(" *C ");
  Serial.print("\n ");
   Serial.print("moisture : ");
  Serial.println(mositure);
   Serial.print("light : ");
  Serial.println(light);
}
void readTemp()
{
      humid = dht.readHumidity();
     temp = dht.readTemperature();
     if (isnan(humid) || isnan(temp) ) {
    //Serial.println("Failed to read from DHT sensor!");
    return;
    }
    if(temp>28)
    {
    analogWrite(fanPin,255); 
    }
    else
    {
      analogWrite(fanPin,0);
    }
  //Serial.print("Humidity: "); 
  //Serial.print(humid);
  //Serial.print(" %\t");
  //Serial.print("Temperature: "); 
  //Serial.print(temp);
  //Serial.print(" *C ");
  //Serial.print("\n ");
}
void readMoist()
{
 mositure=analogRead(moistPin);
 mositure=map(mositure,1023,0,0,100);
 if(mositure >= 65)
 {
  digitalWrite(relayPumpPin,HIGH);
  }  
  else
  {
    digitalWrite(relayPumpPin,LOW);
  }
  //Serial.print("moisture : ");
  //Serial.println(mositure);
} 
void readLight()
{
   light = analogRead(ldrPin);

if (light >= 200) {

  digitalWrite(relayLightPin, LOW);   // turn the Bulb on (HIGH is the voltage level)
}
else
{  
  digitalWrite(relayLightPin, HIGH);    // turn the Bulb off by making the voltage LOW
}
 //Serial.print("light : ");
  //Serial.println(light);
 light=map(light,1020,0,0,100);
}
