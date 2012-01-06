//
//  XMLEventPhotoParser.m
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import "XMLEventPhotoParser.h"
#import "EventPhoto.h"

@implementation XMLEventPhotoParser

@synthesize eventPhotoList;

- (XMLEventPhotoParser *) initXMLParser{
    
    [super init];
    
    [self resetEventPhotoList];
    return self;
}

- (void)parser:(NSXMLParser *)parser didStartElement:(NSString *)elementName namespaceURI:(NSString *)namespaceURI qualifiedName:(NSString *)qName attributes:(NSDictionary *)attributeDict {
    
    //    NSLog(@"didStartElement");
    
    if([elementName isEqualToString:@"eventPhoto"]){
        
        eventPhoto              = [[EventPhoto alloc] init];
        eventPhoto.eventPhotoId = [[attributeDict objectForKey:@"eventPhotoId"] integerValue];
        eventPhoto.fileId       = [[attributeDict objectForKey:@"fileId"] integerValue];
        
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
    
    if([elementName isEqualToString:@"eventPhotos"])
        return;
    
    if([elementName isEqualToString:@"eventPhoto"]) {
        
        [eventPhotoList addObject:eventPhoto];
        
        [eventPhoto release];
        eventPhoto = nil;
        
    }else{
        
        NSString *elementValue = [currentElementValue stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
        
        [eventPhoto setValue:elementValue forKey:elementName];
    }
    
    [currentElementValue release];
    currentElementValue = nil;
}

- (NSMutableArray *) getEventPhotoList {
    
    return eventPhotoList;
}

- (void) resetEventPhotoList {
    
    if( eventPhotoList ){
        
        [eventPhotoList release];
        eventPhotoList = nil;
    }
    
    eventPhotoList = [[NSMutableArray alloc] init];
}

-(void) dealloc {
    
    [eventPhotoList release];
    [eventPhoto release];
    [super dealloc];
}

@end
