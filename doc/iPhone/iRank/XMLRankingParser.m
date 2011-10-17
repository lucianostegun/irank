//
//  XMLRankingParser.m
//  iRank
//
//  Created by Luciano Stegun on 7/11/11.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import "XMLRankingParser.h"
#import "iRankAppDelegate.h"
#import "Ranking.h"


@implementation XMLRankingParser

- (XMLRankingParser *) initXMLParser{
    
    [super init];
    
    appDelegate = (iRankAppDelegate *)[[UIApplication sharedApplication] delegate];
    
    return self;
}

- (void)parser:(NSXMLParser *)parser didStartElement:(NSString *)elementName namespaceURI:(NSString *)namespaceURI qualifiedName:(NSString *)qName attributes:(NSDictionary *)attributeDict {
    
    
    if([elementName isEqualToString:@"rankings"])
        appDelegate.rankingList = [[NSMutableArray alloc] init];
    
    else if([elementName isEqualToString:@"ranking"]){
        
        aRanking               = [[Ranking alloc] init];
        aRanking.rankingId     = [[attributeDict objectForKey:@"id"] integerValue];
        aRanking.rankingTypeId = [[attributeDict objectForKey:@"rankingTypeId"] integerValue];
        aRanking.gameStyleId   = [[attributeDict objectForKey:@"gameStyleId"] integerValue];
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
    
    if([elementName isEqualToString:@"rankings"])
        return;
    
    if([elementName isEqualToString:@"ranking"]) {
        [appDelegate.rankingList addObject:aRanking];
        
        [aRanking release];
        aRanking = nil;
    }else{

        [aRanking setValue:currentElementValue forKey:elementName];
    }
    
    [currentElementValue release];
    currentElementValue = nil;
}

@end
