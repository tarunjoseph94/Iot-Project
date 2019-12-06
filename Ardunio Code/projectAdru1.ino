#include "DHT.h"
#include <ArduinoJson.h>
#define DHTPIN 5
#define DHTTYPE DHT22 
const int moistPin=A0;
const int ldrPin = A0;
const int fanPin =;
const int relayLightPin =;
const int relayPumpPin =;
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
 readmoist();
 readLight();
 StaticJsonBuffer<1000> jsonBuffer;
 JsonObject& root = jsonBuffer.createObject();
  root["humid"] = humid;
  root["temp"] = temp;
  root["moisture"] = mositure;
  root["light"] = light;
if(Serial.available()>0)
{
 root.printTo(Serial);
}
}
readTemp()
{
      humid = dht.readHumidity();
     temp = dht.readTemperature();
     if (isnan(humid) || isnan(temp) ) {
    Serial.println("Failed to read from DHT sensor!");
    return;
    }
    if(temp<28)
    {
    //turn on fan  
    }
    else
    {
      //turn off fan
    }
}
readMoist()
{
long int per=analogRead(moistpin);
 per=map(per,1023,0,0,100) ;
 if(per<55)
 {
  //turn on pump
  }  
  else
  {
    //turn off pump
  }
} 
readLight()
{
   int ldrStatus = analogRead(ldrPin);

if (ldrStatus <= 200) {

  digitalWrite(ledPin, HIGH);   // turn the Bulb on (HIGH is the voltage level)
}
else
{  
  digitalWrite(ledPin, LOW);    // turn the Bulb off by making the voltage LOW
}
 
}
