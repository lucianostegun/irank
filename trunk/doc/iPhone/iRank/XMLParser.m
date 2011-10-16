//
//  XMLParser.m
//  iRank
//
//  Created by Luciano Stegun on 7/11/11.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import "XMLParser.h"
#import "iRankAppDelegate.h"
#import "Ranking.h"


@implementation XMLParser

- (XMLParser *) initXMLParser{
    
    [super init];
    
    appDelegate = (iRankAppDelegate *)[[UIApplication sharedApplication] delegate];
    
    return self;
}

- (void)parser:(NSXMLParser *)parser didStartElement:(NSString *)elementName namespaceURI:(NSString *)namespaceURI qualifiedName:(NSString *)qName attributes:(NSDictionary *)attributeDict {
    
    
    if([elementName isEqualToString:@"rankings"]){
        
        appDelegate.rankingList = [[NSMutableArray alloc] init];
    }else if([elementName isEqualToString:@"ranking"]){
        
        aRanking             = [[Ranking alloc] init];
        aRanking.rankingId   = [[attributeDict objectForKey:@"id"] integerValue];
        
//        NSLog(@"Lendo id valor %i", aRanking.rankingId);
    }
    
//    NSLog(@"Processando elemento: %@", elementName);
}

- (void)parser:(NSXMLParser *)parser foundCharacters:(NSString *)string {
    
    currentElementValue = [[NSMutableString alloc] initWithString:string];    
}

- (void)parser:(NSXMLParser *)parser didEndElement:(NSString *)elementName
  namespaceURI:(NSString *)namespaceURI qualifiedName:(NSString *)qName {
    
    if([elementName isEqualToString:@"rankings"])
        return;
    
    //There is nothing to do if we encounter the Rankings element here.
    //If we encounter the Ranking element howevere, we want to add the ranking object to the array
    // and release the object.
    if([elementName isEqualToString:@"ranking"]) {
        [appDelegate.rankingList addObject:aRanking];
        
        [aRanking release];
        aRanking = nil;
    }
    else{

        [aRanking setValue:currentElementValue forKey:elementName];
    }
    
    [currentElementValue release];
    currentElementValue = nil;
}

@end
