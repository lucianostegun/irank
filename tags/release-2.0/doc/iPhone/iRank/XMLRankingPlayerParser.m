//
//  XMLRankingPlayerParser.m
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import "XMLRankingPlayerParser.h"
#import "RankingPlayer.h"


@implementation XMLRankingPlayerParser

@synthesize player;
@synthesize rankingPlayer;
@synthesize rankingPlayerList;

- (XMLRankingPlayerParser *) initXMLParser{
    
    [super init];
    
    [self resetRankingPlayerList];
    return self;
}

- (void)parser:(NSXMLParser *)parser didStartElement:(NSString *)elementName namespaceURI:(NSString *)namespaceURI qualifiedName:(NSString *)qName attributes:(NSDictionary *)attributeDict {
    
    //    NSLog(@"didStartElement");
    
    if([elementName isEqualToString:@"rankingPlayer"]){
        
        rankingPlayer                 = [[RankingPlayer alloc] init];
        player                        = [[Player alloc] init];
        player.playerId               = [[attributeDict objectForKey:@"playerId"] integerValue];
        rankingPlayer.rankingId       = [[attributeDict objectForKey:@"rankingId"] integerValue];
        rankingPlayer.rankingPosition = [[attributeDict objectForKey:@"rankingPosition"] integerValue];
        
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
    
    if([elementName isEqualToString:@"rankingPlayers"])
        return;
    
    if([elementName isEqualToString:@"rankingPlayer"]) {
        
        [rankingPlayer setPlayer:player];
        [rankingPlayerList addObject:rankingPlayer];
        
        [rankingPlayer release];
        [player release];
        rankingPlayer = nil;
        player = nil;
        
    }else{
        
        NSString *elementValue = [currentElementValue stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
        
        if( ![elementName isEqualToString:@"player"] && ( [elementName isEqualToString:@"firstName"] || [elementName isEqualToString:@"lastName"] || [elementName isEqualToString:@"emailAddress"]) ) {
            
            [player setValue:elementValue forKey:elementName];
        }else{
            
            if( [elementName isEqualToString:@"totalEvents"] )
                [rankingPlayer setTotalEvents:[elementValue intValue]];
            else if( [elementName isEqualToString:@"totalScore"] )
                [rankingPlayer setTotalScore:[elementValue floatValue]];
            else if( [elementName isEqualToString:@"totalPaid"] )
                [rankingPlayer setTotalPaid:[elementValue floatValue]];
            else if( [elementName isEqualToString:@"totalPrize"] )
                [rankingPlayer setTotalPrize:[elementValue floatValue]];
            else if( [elementName isEqualToString:@"totalBalance"] )
                [rankingPlayer setTotalBalance:[elementValue floatValue]];
            else if( [elementName isEqualToString:@"totalAverage"] )
                [rankingPlayer setTotalAverage:[elementValue floatValue]];
//            else
//                [rankingPlayer setValue:elementValue forKey:elementName];
            
            //            NSLog(@"elementName: %@", elementName);
        }
    }
    
    [currentElementValue release];
    currentElementValue = nil;
}

- (NSMutableArray *) getRankingPlayerList {
    
    return rankingPlayerList;
}

- (void) resetRankingPlayerList {
    
    if( rankingPlayerList ){
        
        [rankingPlayerList release];
        rankingPlayerList = nil;
    }
    
    rankingPlayerList = [[NSMutableArray alloc] init];
}

-(void) dealloc {
    
    [player release];
    [rankingPlayerList release];
    [rankingPlayer release];
    [super dealloc];
}

@end
