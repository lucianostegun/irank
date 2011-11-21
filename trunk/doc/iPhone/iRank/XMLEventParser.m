//
//  XMLEventParser.m
//  iRank
//
//  Created by Luciano Stegun on 7/11/11.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import "XMLEventParser.h"
#import "Event.h"


@implementation XMLEventParser

@synthesize event;
@synthesize eventList;

- (XMLEventParser *) initXMLParser{
    
    [super init];
    
    parseComplete = NO;
    [self performSelector:@selector(parsingDidTimeout) withObject:nil afterDelay:10];
    
    [self resetEventList];
    return self;
}

- (void)parsingDidTimeout {
 
    if( parseComplete==NO )
        [[[UIAlertView alloc] initWithTitle:@"Erro" message:@"Não foi possível carregar as informações do evento." delegate:self cancelButtonTitle:@"OK" otherButtonTitles:nil] show];
    
}

- (void)parser:(NSXMLParser *)parser didStartElement:(NSString *)elementName namespaceURI:(NSString *)namespaceURI qualifiedName:(NSString *)qName attributes:(NSDictionary *)attributeDict {
    
//    NSLog(@"didStartElement");
    
    if([elementName isEqualToString:@"event"]){
        
        event           = [[Event alloc] init];
        event.eventId   = [[attributeDict objectForKey:@"id"] integerValue];
        event.rankingId = [[attributeDict objectForKey:@"rankingId"] integerValue];

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
    
//    NSLog(@"didEndElement");
    
    if([elementName isEqualToString:@"events"])
        return;
    
    if([elementName isEqualToString:@"event"]) {
        [eventList addObject:event];

        [event release];
        event = nil;
    }else{
        
        NSString *elementValue = [currentElementValue stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
        
        if( [elementName isEqualToString:@"buyin"] )
            [event setBuyin:[elementValue floatValue]];
        else if( [elementName isEqualToString:@"entranceFee"] )
            [event setEntranceFee:[elementValue floatValue]];
        else if( [elementName isEqualToString:@"paidPlaces"] )
            [event setPaidPlaces:[elementValue intValue]];
        else if( [elementName isEqualToString:@"savedResult"] )
            [event setSavedResult:[elementValue boolValue]];
        else if( [elementName isEqualToString:@"isPastDate"] )
            [event setIsPastDate:[elementValue boolValue]];
        else if( [elementName isEqualToString:@"isMyEvent"] )
            [event setIsMyEvent:[elementValue boolValue]];
        else if( [elementName isEqualToString:@"isEditable"] )
            [event setIsEditable:[elementValue boolValue]];
        else
            [event setValue:currentElementValue forKey:elementName];
    }
    
    [currentElementValue release];
    currentElementValue = nil;
}

- (NSMutableArray *) getEventList {

    return eventList;
}

- (void) resetEventList {
    
    if( eventList ){

        [eventList release];
        eventList = nil;
    }
    
    eventList = [[NSMutableArray alloc] init];
}

- (void)parserDidEndDocument:(NSXMLParser *)parser {
    
    parseComplete = YES;
}

-(void) dealloc {
    
    [eventList release];
    [event release];
    [super dealloc];
}

@end
