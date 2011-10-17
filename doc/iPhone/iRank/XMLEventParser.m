//
//  XMLEventParser.m
//  iRank
//
//  Created by Luciano Stegun on 7/11/11.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import "XMLEventParser.h"
#import "iRankAppDelegate.h"
#import "Event.h"


@implementation XMLEventParser

- (XMLEventParser *) initXMLParser{
    
    [super init];
    
    appDelegate = (iRankAppDelegate *)[[UIApplication sharedApplication] delegate];
    
    return self;
}

- (void)parser:(NSXMLParser *)parser didStartElement:(NSString *)elementName namespaceURI:(NSString *)namespaceURI qualifiedName:(NSString *)qName attributes:(NSDictionary *)attributeDict {
    
    
    if([elementName isEqualToString:@"events"])
        appDelegate.eventList = [[NSMutableArray alloc] init];
    
    else if([elementName isEqualToString:@"event"]){
        
        aEvent           = [[Event alloc] init];
        aEvent.eventId   = [[attributeDict objectForKey:@"id"] integerValue];
        aEvent.rankingId = [[attributeDict objectForKey:@"rankingId"] integerValue];
        return;
    }
}

- (void)parser:(NSXMLParser *)parser foundCharacters:(NSString *)string {

    if(!currentElementValue)
        currentElementValue = [[NSMutableString alloc] initWithString:string];
    else
        [currentElementValue appendString:string];
}

- (void)parser:(NSXMLParser *)parser didEndElement:(NSString *)elementName
  namespaceURI:(NSString *)namespaceURI qualifiedName:(NSString *)qName {
    
    if([elementName isEqualToString:@"events"])
        return;
    
    if([elementName isEqualToString:@"event"]) {
        [appDelegate.eventList addObject:aEvent];
        
        [aEvent release];
        aEvent = nil;
    }else{
        
        [aEvent setValue:currentElementValue forKey:elementName];
    }
    
    [currentElementValue release];
    currentElementValue = nil;
}

@end
