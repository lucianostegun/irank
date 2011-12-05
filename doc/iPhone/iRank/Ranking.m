//
//  Ranking.m
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import "Ranking.h"
#import "XMLRankingParser.h"
#import "XMLRankingPlayerParser.h"
#import "iRankAppDelegate.h"
#import "RankingPlayer.h"
#import "Player.h"

@implementation Ranking
@synthesize rankingId;
@synthesize gameStyleId;
@synthesize players;
@synthesize events;
@synthesize rankingTypeId;
@synthesize rankingName;
@synthesize credit;
@synthesize gameStyle;
@synthesize startDate;
@synthesize finishDate;
@synthesize isPrivate;
@synthesize rankingType;
@synthesize defaultBuyin;
@synthesize rankingPlayerList;
@synthesize eventList;
@synthesize isMyRanking;

- (id)initWithRankingId:(int)theRankingId {
    
    self = [self init];
    
    rankingId = theRankingId;
//    NSLog(@"rankingId: %i", rankingId);
    
//    NSString *eventResultPath = [Event eventArrayPath:[NSString stringWithFormat:@"result-%i", eventId]];
//    
//    NSFileManager *manager = [NSFileManager defaultManager];
//    
//    self.hasOfflineResult = [manager fileExistsAtPath:eventResultPath];
//    
//    if( self.hasOfflineResult )
//        [self loadArchivedEventPlayerList];
//    
    return self;
}

-(NSString *)rankingName {
    
    return [rankingName stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
}

-(NSString *)gameStyle {
    
    return [gameStyle stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
}

-(NSString *)startDate {
    
    return [startDate stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
}

-(NSString *)finishDate {
    
    return [finishDate stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
}

-(NSString *)rankingType {
    
    return [rankingType stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
}

- (NSString *)description {
    
    return [NSString stringWithFormat:@"%d: %@", rankingId, rankingName];
}

- (void)loadPlayerList {
    
    NSURL *url = [[NSURL alloc] initWithString:[NSString stringWithFormat:@"http://%@/ios.php/ranking/getXml/model/rankingPlayer/rankingId/%i", serverAddress, rankingId]];
    
//    NSLog(@"url: %@", url.relativeString);
    
    XMLRankingPlayerParser *rankingPlayerParser = [[XMLRankingPlayerParser alloc] initXMLParser];
    
	NSURLRequest *rankingPlayerRequest = [NSURLRequest requestWithURL:url cachePolicy: NSURLRequestReloadIgnoringCacheData timeoutInterval:45];
	NSError *requestError              = nil;
	NSData *response                   = [NSURLConnection sendSynchronousRequest:rankingPlayerRequest returningResponse:nil error:&requestError]; 
    BOOL success;
    
//    NSString *result = [[NSString alloc] initWithData:response encoding:NSASCIIStringEncoding];
//    NSLog(@"result: %@", result);
    
    //    NSString *rankingPath = [Ranking rankingArrayPath:@"list"];
    //    NSLog(@"rankingPath: %@", rankingPath);
    
    if(requestError == nil) {
        
		NSXMLParser *parser = [[NSXMLParser alloc] initWithData:response];
        
		[parser setDelegate:rankingPlayerParser];
		[parser setShouldProcessNamespaces:YES];
		[parser setShouldReportNamespacePrefixes:YES];
		[parser setShouldResolveExternalEntities:NO];
		success = [parser parse];
		[parser release];
        
        rankingPlayerList = [[NSMutableArray alloc] initWithArray:[rankingPlayerParser getRankingPlayerList]];
	}else{
        
	}
}

- (NSMutableArray*)sortedRankingPlayerList {
    
    NSArray *sorted = [rankingPlayerList sortedArrayUsingComparator:^(id obj1, id obj2){
        if ([obj1 isKindOfClass:[RankingPlayer class]] && [obj2 isKindOfClass:[RankingPlayer class]]) {
            RankingPlayer *s1 = (RankingPlayer*)obj1;
            RankingPlayer *s2 = (RankingPlayer*)obj2;
            
            if (s1.rankingPosition < s2.rankingPosition) {
                return (NSComparisonResult)NSOrderedAscending;
            } else if (s1.rankingPosition > s2.rankingPosition) {
                return (NSComparisonResult)NSOrderedDescending;
            }
        }
        
        // TODO: default is the same?
        return (NSComparisonResult)NSOrderedSame;
    }];
    
    return [[NSMutableArray alloc] initWithArray:sorted];
}

- (void)addPlayer:(int)playerId firstName:(NSString *)firstName lastName:(NSString *)lastName emailAddress:(NSString *)emailAddress {
    
    BOOL playerExists = NO;
    
    for(RankingPlayer *rankingPlayer in rankingPlayerList){
        
        if( rankingPlayer.player.playerId==playerId ){
            
            playerExists = YES;
            break;
        }
    }
    
    if( !playerExists ){
        
        Player *player = [[Player alloc] init];
        [player setPlayerId:playerId];
        [player setFirstName:firstName];
        [player setLastName:lastName];
        [player setEmailAddress:emailAddress];
        
        RankingPlayer *rankingPlayer = [[RankingPlayer alloc] init];
        [rankingPlayer setPlayer:player];
        
        NSLog(@"rankingPlayer: %@", rankingPlayer);
        [rankingPlayerList addObject:rankingPlayer];
    }
}

+ (NSMutableArray *)loadRankingList:(int)userSiteId {
    
    NSMutableArray *rankingList;
    
    NSURL *url = [[NSURL alloc] initWithString:[NSString stringWithFormat:@"http://%@/ios.php/ranking/getXml/model/list/userSiteId/%i", serverAddress, userSiteId]];
    
//    NSLog(@"url: %@", url.relativeString);
    
    XMLRankingParser *rankingParser = [[XMLRankingParser alloc] initXMLParser];
    
	NSURLRequest *rankingRequest = [NSURLRequest requestWithURL:url cachePolicy: NSURLRequestReloadIgnoringCacheData timeoutInterval:45];
	NSError *requestError        = nil;
	NSData *response             = [NSURLConnection sendSynchronousRequest:rankingRequest returningResponse:nil error:&requestError]; 
    BOOL success;
    
//    NSString *rankingPath = [Ranking rankingArrayPath:@"list"];
//    NSLog(@"rankingPath: %@", rankingPath);
    
    if(requestError == nil) {
        
		NSXMLParser *parser = [[NSXMLParser alloc] initWithData:response];
        
		[parser setDelegate:rankingParser];
		[parser setShouldProcessNamespaces:YES];
		[parser setShouldReportNamespacePrefixes:YES];
		[parser setShouldResolveExternalEntities:NO];
		success = [parser parse];
		[parser release];
        
        rankingList = [[rankingParser getRankingList] copy];
//        NSLog(@"rankingList: %@", rankingList);
        
//        [NSKeyedArchiver archiveRootObject:rankingList toFile:rankingPath];        
	} else {
        
//        rankingList = [Ranking loadArchivedRankingList:rankingType userSiteId:userSiteId limit:limit];
	}
    
    return rankingList;
}

+ (NSString *)rankingArrayPath:(NSString *)sufix {
    
    return pathInDocumentDirectory([NSString stringWithFormat:@"Rankings-%@.data", sufix]);
}

- (void)dealloc {
    
    [rankingName release];
    [gameStyle release];
    [startDate release];
    [finishDate release];
    [rankingType release];
    [eventList release];
//    [rankingPlayerList release];
    [super dealloc];
}

@end
