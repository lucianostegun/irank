//
//  EventClass.m
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import "Event.h"
#import "EventPlayer.h"
#import "Constants.h"
#import "XMLEventParser.h"

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
@synthesize inviteStatus;
@synthesize isMyEvent;
@synthesize isPastDate;
@synthesize isEditable;
@synthesize gameStyle;
@synthesize filteredPlayerList;

- (id)init {
    
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

- (void)filterPlayerList {
    
    if( filteredPlayerList )
        return;
    
    NSMutableArray *eventPlayerListTemp = [[NSMutableArray alloc] initWithArray:eventPlayerList];
    
    int eventPosition = 0;
    
    for (EventPlayer *eventPlayer in eventPlayerList) {
        if( !eventPlayer.enabled ){
            [eventPlayerListTemp removeObject:eventPlayer];
            eventPlayer.eventPosition = 0;
        }else{
            
            eventPlayer.eventPosition = ++eventPosition;
            eventPlayer.buyin = [self buyin];
        }
    }
    
    [eventPlayerList release];
    eventPlayerList = nil;

    eventPlayerList = eventPlayerListTemp;
    
    filteredPlayerList = YES;
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

- (void) dealloc {
    
    [eventName release];
    [rankingName release];
    [eventPlace release];
    [eventDate release];
    [startTime release];
    [comments release];
    [eventPlayerList release];
    [inviteStatus release];
    [gameStyle release];
    [super dealloc];
}

-(void)saveResult:(id)sender {
    
    
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
    
    //        NSLog(@"stringData: %@", stringData);
    
    const char *bytes = [[NSString stringWithFormat:@"eventResultXml=%@", stringData] UTF8String];
    
    NSURL *url = [NSURL URLWithString:[NSString stringWithFormat:@"http://%@/ios.php/event/saveResult", serverAddress]];
    NSMutableURLRequest *request = [NSMutableURLRequest requestWithURL:url cachePolicy:NSURLRequestReloadIgnoringCacheData timeoutInterval:60];
    
    [request setHTTPMethod:@"POST"];
    [request setHTTPBody:[NSData dataWithBytes:bytes length:strlen(bytes)]];
    
    [NSURLConnection connectionWithRequest:request delegate:self];
    
    [sender performSelector:@selector(concludeSaveResult) withObject:nil afterDelay:0];
}

- (void)connection: (NSURLConnection *)connection didReceiveResponse:(NSURLResponse *)response {
    
    //    NSLog(@"didReceiveResponse");
    //    [activityIndicator setHidden:YES];
}

- (void)connection: (NSURLConnection *)connection didReceiveData:(NSData *)data {
    
    //    NSLog(@"didReceiveData");
    
//    NSString *result = [[NSString alloc] initWithData:data encoding:NSASCIIStringEncoding];    
    
    
//    [result release];
}

- (void)connectionDidFinishLoading:(NSURLConnection *)connection {
    
//
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

@end
