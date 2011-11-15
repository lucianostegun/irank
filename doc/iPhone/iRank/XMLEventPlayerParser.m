//
//  XMLEventPlayerParser.m
//  iRank
//
//  Created by Luciano Stegun on 7/11/11.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import "XMLEventPlayerParser.h"
#import "EventPlayer.h"


@implementation XMLEventPlayerParser

@synthesize player;
@synthesize eventPlayer;
@synthesize eventPlayerList;

- (XMLEventPlayerParser *) initXMLParser{
    
    [super init];
    
    [self resetEventPlayerList];
    return self;
}

- (void)parser:(NSXMLParser *)parser didStartElement:(NSString *)elementName namespaceURI:(NSString *)namespaceURI qualifiedName:(NSString *)qName attributes:(NSDictionary *)attributeDict {
    
    //    NSLog(@"didStartElement");
    
    if([elementName isEqualToString:@"eventPlayer"]){
        
        eventPlayer         = [[EventPlayer alloc] init];
        player              = [[Player alloc] init];
        player.playerId     = [[attributeDict objectForKey:@"playerId"] integerValue];
        eventPlayer.eventId = [[attributeDict objectForKey:@"eventId"] integerValue];

        return;
    }
}

- (void)parser:(NSXMLParser *)parser foundCharacters:(NSString *)string {
    
    //    NSLog(@"foundCharacters");
    
    if(!currentElementValue)
        currentElementValue = [[NSMutableString alloc] initWithString:string];
    else
        [currentElementValue appendString:string];
}

- (void)parser:(NSXMLParser *)parser didEndElement:(NSString *)elementName
  namespaceURI:(NSString *)namespaceURI qualifiedName:(NSString *)qName {
    
    if([elementName isEqualToString:@"eventPlayers"])
        return;

    if([elementName isEqualToString:@"eventPlayer"]) {
        
        [eventPlayer setPlayer:player];
        [eventPlayerList addObject:eventPlayer];

        [eventPlayer release];
        [player release];
        eventPlayer = nil;
        player = nil;
        
    }else{
        
        NSString *elementValue = [currentElementValue stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
        
        if( ![elementName isEqualToString:@"player"] && ( [elementName isEqualToString:@"firstName"] || [elementName isEqualToString:@"lastName"] || [elementName isEqualToString:@"emailAddress"]) ) {

            [player setValue:elementValue forKey:elementName];
        }else{
            
            if( [elementName isEqualToString:@"enabled"] )
                [eventPlayer setEnabled:[elementValue boolValue]];
            else
                [eventPlayer setValue:elementValue forKey:elementName];
        }
    }
    
    [currentElementValue release];
    currentElementValue = nil;
}

- (NSMutableArray *) getEventPlayerList {
    
    return eventPlayerList;
}

- (void) resetEventPlayerList {
    
    if( eventPlayerList ){
        
        [eventPlayerList release];
        eventPlayerList = nil;
    }
    
    eventPlayerList = [[NSMutableArray alloc] init];
}

-(void) dealloc {

    [player release];
    [eventPlayerList release];
    [eventPlayer release];
    [super dealloc];
}

@end
