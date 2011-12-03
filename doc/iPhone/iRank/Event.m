//
//  EventClass.m
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import "Event.h"
#import "EventPlayer.h"
#import "XMLEventParser.h"
#import "XMLEventPlayerParser.h"
#import "iRankAppDelegate.h"

@implementation Event

@synthesize eventName, rankingName, eventPlace, eventDate, startTime;
@synthesize eventId;
@synthesize rankingId;
@synthesize comments;
@synthesize buyin;
@synthesize entranceFee;
@synthesize paidPlaces;
@synthesize savedResult;
@synthesize eventPlayerList;
@synthesize eventPlayerListFiltered;
@synthesize inviteStatus;
@synthesize isMyEvent;
@synthesize isPastDate;
@synthesize isEditable;
@synthesize hasOfflineResult;
@synthesize gameStyle;
//@synthesize filteredPlayerList;

- (id)init {
    
    self = [super init];
 
    eventPlayerList = nil;
    eventPlayerListFiltered = nil;
    return self;
}

- (id)initWithEventId:(int)theEventId {
    
    self = [self init];
    
    eventId = theEventId;
    
    NSString *eventResultPath = [Event eventArrayPath:[NSString stringWithFormat:@"result-%i", eventId]];
    
    NSFileManager *manager = [NSFileManager defaultManager];
    
    self.hasOfflineResult = [manager fileExistsAtPath:eventResultPath];
    
    if( self.hasOfflineResult )
        [self loadArchivedEventPlayerList];
    
    return self;
}

- (void)encodeWithCoder:(NSCoder *)encoder {
    
    [encoder encodeInt:eventId forKey:@"eventId"];
    [encoder encodeInt:rankingId forKey:@"rankingId"];
    
    [encoder encodeObject:eventName forKey:@"eventName"];
    [encoder encodeObject:rankingName forKey:@"rankingName"];
    [encoder encodeObject:eventPlace forKey:@"eventPlace"];
    [encoder encodeObject:eventDate forKey:@"eventDate"];
    [encoder encodeObject:startTime forKey:@"startTime"];
    [encoder encodeObject:comments forKey:@"comments"];
    [encoder encodeObject:comments forKey:@"inviteStatus"];
    [encoder encodeObject:gameStyle forKey:@"gameStyle"];
    [encoder encodeInt:rankingPlaceId forKey:@"rankingPlaceId"];
    [encoder encodeObject:eventPlayerList forKey:@"eventPlayerList"];
    
    [encoder encodeInt:invites forKey:@"invites"];
    [encoder encodeInt:players forKey:@"players"];
     
    [encoder encodeBool:sentEmail forKey:@"sentEmail"];
    [encoder encodeBool:isFreeroll forKey:@"isFreeroll"];
    [encoder encodeBool:savedResult forKey:@"savedResult"];
    [encoder encodeBool:isMyEvent forKey:@"isMyEvent"];
    [encoder encodeBool:isPastDate forKey:@"isPastDate"];
    [encoder encodeBool:isEditable forKey:@"isEditable"];

    [encoder encodeFloat:prizePot forKey:@"prizePot"];
    [encoder encodeFloat:buyin forKey:@"buyin"];
    [encoder encodeFloat:entranceFee forKey:@"entranceFee"];
    [encoder encodeFloat:paidPlaces forKey:@"paidPlaces"];
}

- (id)initWithCoder:(NSCoder *)decoder {
    
    [super init];
    
    [self setEventId:      [decoder decodeIntForKey:@"eventId"]];
    [self setRankingId:    [decoder decodeIntForKey:@"rankingId"]];
    [self setEventName:    [decoder decodeObjectForKey:@"eventName"]];
    [self setRankingName:  [decoder decodeObjectForKey:@"rankingName"]];
    [self setEventPlace:   [decoder decodeObjectForKey:@"eventPlace"]];
    [self setEventDate:    [decoder decodeObjectForKey:@"eventDate"]];
    [self setStartTime:    [decoder decodeObjectForKey:@"startTime"]];
    [self setComments:     [decoder decodeObjectForKey:@"comments"]];
    [self setInviteStatus: [decoder decodeObjectForKey:@"inviteStatus"]];
    [self setGameStyle:    [decoder decodeObjectForKey:@"gameStyle"]];
    [self setSavedResult:  [decoder decodeBoolForKey:@"savedResult"]];
    [self setIsMyEvent:    [decoder decodeBoolForKey:@"isMyEvent"]];
    [self setIsPastDate:   [decoder decodeBoolForKey:@"isPastDate"]];
    [self setIsEditable:   [decoder decodeBoolForKey:@"isEditable"]];
    [self setBuyin:        [decoder decodeFloatForKey:@"buyin"]];
    [self setEntranceFee:  [decoder decodeFloatForKey:@"entranceFee"]];
    [self setPaidPlaces:   [decoder decodeFloatForKey:@"paidPlaces"]];

    rankingPlaceId = [decoder decodeIntForKey:@"rankingPlaceId"];
    invites        = [decoder decodeIntForKey:@"invites"];
    players        = [decoder decodeIntForKey:@"players"];
    sentEmail      = [decoder decodeBoolForKey:@"sentEmail"];
    isFreeroll     = [decoder decodeBoolForKey:@"isFreeroll"];
    prizePot       = [decoder decodeFloatForKey:@"prizePot"];
    
    return self;
}

-(NSString *)eventName {
    
    return [eventName stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
}

-(NSString *)rankingName {
    
    return [rankingName stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
}

-(NSString *)eventPlace {
    
    return [eventPlace stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
}

-(NSString *)eventDate {
    
    return [eventDate stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
}

-(NSString *)startTime {
    
    return [startTime stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
}

-(NSString *)comments {
    
    return [comments stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
}

-(NSString *)inviteStatus {
    
    return [inviteStatus stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
}

-(NSString *)gameStyle {
    
    return [gameStyle stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
}

- (NSString *)description {
    
    return [NSString stringWithFormat:@"%d: %@ @ %@", eventId, eventName, eventPlace];
}

- (NSMutableArray *)getFilteredPlayerList {
    
    if( eventPlayerListFiltered!=nil ){
        
        [eventPlayerListFiltered release];
        eventPlayerListFiltered = nil;
    }
    
    eventPlayerListFiltered = [[NSMutableArray alloc] init];
    
    for (EventPlayer *eventPlayer in eventPlayerList) {
        
        if( !eventPlayer.enabled ){
            
            eventPlayer.eventPosition = 0;
        }else{
            
            [eventPlayerListFiltered addObject:eventPlayer];
            eventPlayer.buyin = [self buyin];
        }
    }
    
//    NSLog(@"eventPlayerListFiltered: %@", eventPlayerListFiltered);
    NSArray *sorted = [eventPlayerListFiltered sortedArrayUsingComparator:^(id obj1, id obj2){
        if ([obj1 isKindOfClass:[EventPlayer class]] && [obj2 isKindOfClass:[EventPlayer class]]) {
            EventPlayer *s1 = (EventPlayer*)obj1;
            EventPlayer *s2 = (EventPlayer*)obj2;
            
            if (s1.eventPosition < s2.eventPosition) {
                return (NSComparisonResult)NSOrderedAscending;
            } else if (s1.eventPosition > s2.eventPosition) {
                return (NSComparisonResult)NSOrderedDescending;
            }
        }
        
        // TODO: default is the same?
        return (NSComparisonResult)NSOrderedSame;
    }];
    
    [eventPlayerListFiltered release];
    eventPlayerListFiltered = nil;
    eventPlayerListFiltered = [[NSMutableArray alloc] initWithArray:sorted];

//    NSLog(@"eventPlayerListFiltered: %@", eventPlayerListFiltered);

    return eventPlayerListFiltered;
}

- (float)totalBuyins {
    
    float buyins = 0;
    float rebuys = 0;
    float addons = 0;
    
    for (EventPlayer *eventPlayer in eventPlayerList) {
        
        buyins += eventPlayer.buyin;
        rebuys += eventPlayer.rebuy;
        addons += eventPlayer.addon;
    }
    
    return ((buyins+rebuys+addons)/self.buyin);
}

-(void)saveResult:(id)sender saveOffline:(BOOL)saveResultOffline {
    
    iRankAppDelegate *appDelegate = (iRankAppDelegate *)[[UIApplication sharedApplication] delegate];
    
    NSString *stringData = [NSString stringWithFormat:@"<?xml version=\"1.0\"?>\n<eventResults eventId=\"%i\">", eventId];
    
    for(EventPlayer *eventPlayer in eventPlayerList){
        
        stringData = [stringData stringByAppendingFormat:@"\n\t<eventResult peopleId=\"%i\">", eventPlayer.player.playerId];
        stringData = [stringData stringByAppendingFormat:@"\n\t\t<eventPosition>%i</eventPosition>", eventPlayer.eventPosition];
        stringData = [stringData stringByAppendingFormat:@"\n\t\t<buyin>%f</buyin>", eventPlayer.buyin];
        stringData = [stringData stringByAppendingFormat:@"\n\t\t<rebuy>%f</rebuy>", eventPlayer.rebuy];
        stringData = [stringData stringByAppendingFormat:@"\n\t\t<addon>%f</addon>", eventPlayer.addon];
        stringData = [stringData stringByAppendingFormat:@"\n\t\t<prize>%f</prize>", eventPlayer.prize];
        stringData = [stringData stringByAppendingString:@"\n\t</eventResult>"];
    }
    
    stringData = [stringData stringByAppendingString:@"\n</eventResults>"];

    if( saveResultOffline ){
        
        NSString *eventResultPath = [Event eventArrayPath:[NSString stringWithFormat:@"result-%i", eventId]];
        NSLog(@"Arquivando o resultado em : %@", eventResultPath);
        [NSKeyedArchiver archiveRootObject:eventResultPath toFile:eventResultPath];   
        
        NSString *eventResultPlayerListPath = [Event eventArrayPath:[NSString stringWithFormat:@"playerList-%i", eventId]];
        NSLog(@"Arquivando o resultado em : %@", eventResultPlayerListPath);
        [NSKeyedArchiver archiveRootObject:eventPlayerList toFile:eventResultPlayerListPath];
        
        [appDelegate hideLoadingView];
        [appDelegate showAlert:@"Resultado salvo" message:@"O resultado do evento foi salvo com sucesso!"];
        
        return;
    }
    
    NSLog(@"stringData: %@", stringData);
    
    const char *bytes = [[NSString stringWithFormat:@"eventResultXml=%@", stringData] UTF8String];
    
    NSURL *url                   = [NSURL URLWithString:[NSString stringWithFormat:@"http://%@/ios.php/event/saveResult", serverAddress]];
    NSMutableURLRequest *request = [NSMutableURLRequest requestWithURL:url cachePolicy:NSURLRequestReloadIgnoringCacheData timeoutInterval:241];
  	NSError *requestError        = nil;
    
    [request setHTTPMethod:@"POST"];
    [request setHTTPBody:[NSData dataWithBytes:bytes length:strlen(bytes)]];
    
	NSData *response = [NSURLConnection sendSynchronousRequest:request returningResponse:nil error:&requestError]; 

    if(requestError == nil) {
        
        NSString *result = [[NSString alloc] initWithData:response encoding:NSASCIIStringEncoding];
        
        if( [result isEqualToString:@"saveSuccess"] ){
         
            [sender performSelector:@selector(concludeSaveResult) withObject:nil afterDelay:0];
            self.hasOfflineResult = NO;
            self.savedResult      = YES;
            
            NSString *eventResultPath = [Event eventArrayPath:[NSString stringWithFormat:@"result-%i", eventId]];
            
            [[NSFileManager defaultManager] removeItemAtPath:eventResultPath error:nil];
        }else
            [sender performSelector:@selector(concludeSaveResultWithError) withObject:nil afterDelay:0];
	} else {
        
        [sender performSelector:@selector(concludeSaveResultWithError) withObject:nil afterDelay:0];
	}
}

+ (NSMutableArray *)loadEventList:(NSString *)eventType userSiteId:(int)userSiteId limit:(int)limit {
    
    NSMutableArray *eventList;
    
    NSURL *url = [[NSURL alloc] initWithString:[NSString stringWithFormat:@"http://%@/ios.php/event/getXml/model/%@Events/userSiteId/%i/limit/%i", serverAddress, eventType, userSiteId, limit]];
    
    XMLEventParser *eventParser = [[XMLEventParser alloc] initXMLParser];
    
	NSURLRequest *eventRequest = [NSURLRequest requestWithURL:url cachePolicy: NSURLRequestReloadIgnoringCacheData timeoutInterval:45];
	NSError *requestError      = nil;
	NSData *response           = [NSURLConnection sendSynchronousRequest:eventRequest returningResponse:nil error:&requestError]; 
    BOOL success;

//    NSLog(@"url: %@", url);
    
    NSString *eventPath = [Event eventArrayPath:eventType];
    NSLog(@"eventPath: %@", eventPath);
    
    if(requestError == nil) {
        
		NSXMLParser *parser = [[NSXMLParser alloc] initWithData:response];
        
		[parser setDelegate:eventParser];
		[parser setShouldProcessNamespaces:YES];
		[parser setShouldReportNamespacePrefixes:YES];
		[parser setShouldResolveExternalEntities:NO];
		success = [parser parse];
		[parser release];
        
        eventList = [[eventParser getEventList] copy];
        
        [NSKeyedArchiver archiveRootObject:eventList toFile:eventPath];        
	} else {
        
        eventList = [Event loadArchivedEventList:eventType userSiteId:userSiteId limit:limit];
	}
    
    return eventList;
}

-(void)reloadPlayerList:(id)sender {
    
    iRankAppDelegate *appDelegate = (iRankAppDelegate *)[[UIApplication sharedApplication] delegate];
    
    int userSiteId = [appDelegate userSiteId];
    
    NSURL *url = [[NSURL alloc] initWithString:[NSString stringWithFormat:@"http://%@/ios.php/event/getXml/model/eventPlayer/userSiteId/%i/eventId/%d", serverAddress, userSiteId, eventId]];
    
    NSLog(@"url: %@", url.relativeString);
    
    NSXMLParser *xmlParser = [[NSXMLParser alloc] initWithContentsOfURL:url];    
    
    XMLEventPlayerParser *parser = [[XMLEventPlayerParser alloc] initXMLParser];
    
    [xmlParser setDelegate:parser];
    
    BOOL success = [xmlParser parse];
    
    if( !success ) 
        return [appDelegate showAlert:@"Erro" message:@"Não foi possível recuperar a lista de jogadores."];
    
    [self setEventPlayerList: [[parser getEventPlayerList] retain]];
    
//    if( filter )
//        [self filterPlayerList];
    
    NSNotification *note = [NSNotification notificationWithName:kEventPlayerListLoadSuccess object:sender];
    [[NSNotificationCenter defaultCenter] postNotification:note];
}

- (void)loadArchivedEventPlayerList {
    
    NSString *eventPlayerListPath = [Event eventArrayPath:[NSString stringWithFormat:@"playerList-%i", eventId]];
    
    NSLog(@"Timeout ao processar o XML de últimos eventos");
    NSLog(@"Carregando a lista de jogadores arquivada no endereço: %@", eventPlayerListPath);
    
    eventPlayerList = [NSKeyedUnarchiver unarchiveObjectWithFile:eventPlayerListPath];
    
    if( !eventPlayerList )
        eventPlayerList = [NSMutableArray array];
    
    [eventPlayerList retain];
}

+ (NSMutableArray *)loadArchivedEventList:(NSString *)eventType userSiteId:(int)userSiteId limit:(int)limit {

    NSMutableArray *eventList;
    NSString *eventPath = [Event eventArrayPath:eventType];
    
    NSLog(@"Timeout ao processar o XML de últimos eventos");
    NSLog(@"Carregando a lista arquivada no endereço: %@", eventPath);
    
    eventList = [NSKeyedUnarchiver unarchiveObjectWithFile:eventPath];
    
    if( !eventList )
        eventList = [NSMutableArray array];
    
    [eventList retain];
    
    return eventList;
}

+ (NSString *)eventArrayPath:(NSString *)sufix {
    
    return pathInDocumentDirectory([NSString stringWithFormat:@"Events-%@.data", sufix]);
}

- (void) dealloc {
    
    [eventName release];
    [rankingName release];
    [eventPlace release];
    [eventDate release];
    [startTime release];
    [comments release];
    [eventPlayerList release];
    [eventPlayerListFiltered release];
    [inviteStatus release];
    [gameStyle release];
    [super dealloc];
}

@end
