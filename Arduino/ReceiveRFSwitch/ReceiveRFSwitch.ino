#include <RCSwitch.h>

const int led = 4;

RCSwitch mySwitch = RCSwitch();

void setup() {
  Serial.begin(9600);
  mySwitch.enableReceive(1);  // Receiver on inerrupt 0 => that is pin #2
  pinMode(led, OUTPUT);
}

void loop() {
  
  if (mySwitch.available()) {
    
    int value = mySwitch.getReceivedValue();
    
    if (value == 0) {
      Serial.print("Unknown encoding");
    } else {
      Serial.print("Received ");
      Serial.println( mySwitch.getReceivedValue() );
      /*Serial.print(" / ");
      Serial.print( mySwitch.getReceivedBitlength() );
      Serial.print("bit ");
      Serial.print("Protocol: ");
      Serial.println( mySwitch.getReceivedProtocol() );*/
      
      if (mySwitch.getReceivedValue() == 211011) digitalWrite(led, HIGH);
      else if (mySwitch.getReceivedValue() == 211010) digitalWrite(led, LOW);
      
    }

    mySwitch.resetAvailable();
  }
}
