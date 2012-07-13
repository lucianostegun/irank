//
//  XMLRankingParser.m
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import "XMLRankingParser.h"
#import "Ranking.h"

@implementation XMLRankingParser
@synthesize ranking;
@synthesize rankingList;

- (XMLRankingParser *) initXMLParser{
    
    [super init];
    
    [self resetRankingList];
    return self;
}

- (void)parsingDidTimeout {
    
    [[[UIAlertView alloc] initWithTitle:@"Erro" message:@"Não foi possível carregar as informações do ranking." delegate:self cancelButtonTitle:@"OK" otherButtonTitles:nil] show];
    
}

- (void)parser:(NSXMLParser *)parser didStartElement:(NSString *)elementName namespaceURI:(NSString *)namespaceURI qualifiedName:(NSString *)qName attributes:(NSDictionary *)attributeDict {
    
    //    NSLog(@"didStartElement");
    
    if([elementName isEqualToString:@"ranking"]){
        
        int rankingId = [[attributeDict objectForKey:@"id"] integerValue];
        
        ranking               = [[Ranking alloc] initWithRankingId:rankingId];
        ranking.gameStyleId   = [[attributeDict objectForKey:@"gameStyleId"] integerValue];
        ranking.rankingTypeId = [[attributeDict objectForKey:@"rankingTypeId"] integerValue];
        ranking.events        = [[attributeDict objectForKey:@"events"] integerValue];
        ranking.players       = [[attributeDict objectForKey:@"players"] integerValue];
        
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
    
    if([elementName isEqualToString:@"rankings"])
        return;
    
    if([elementName isEqualToString:@"ranking"]) {
        [rankingList addObject:ranking];
        
        [ranking release];
        ranking = nil;
    }else{
        
        NSString *elementValue = [currentElementValue stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
        
        if( [elementName isEqualToString:@"credit"] )
            [ranking setCredit:[elementValue floatValue]];
        else if( [elementName isEqualToString:@"isPrivate"] )
            [ranking setIsPrivate:[elementValue boolValue]];
        else if( [elementName isEqualToString:@"isMyRanking"] )
            [ranking setIsMyRanking:[elementValue boolValue]];
        else if( [elementName isEqualToString:@"defaultBuyin"] )
            [ranking setDefaultBuyin:[elementValue floatValue]];
        else
            [ranking setValue:currentElementValue forKey:elementName];
    }
    
    [currentElementValue release];
    currentElementValue = nil;
}

- (NSMutableArray *) getRankingList {
    
    return rankingList;
}

- (void) resetRankingList {
    
    if( rankingList ){
        
        [rankingList release];
        rankingList = nil;
    }
    
    rankingList = [[NSMutableArray alloc] init];
}

- (void)parserDidEndDocument:(NSXMLParser *)parser {
    
}

-(void) dealloc {
    
    [rankingList release];
    [ranking release];
    [super dealloc];
}

@end
