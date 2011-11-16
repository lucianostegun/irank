//
//  EventClass.m
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import "Event.h"
#import "EventPlayer.h"

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

- (id)init {
    
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
    
//    NSString *urlString = [NSString stringWithFormat:@"http://%@/ios.php/event/getPaidPlaces/eventId/%i/buyins/%f", serverAddress, event.eventId, [event totalBuyins]];
//    
//    NSURL *url = [NSURL URLWithString:urlString];
//    
//    NSURLRequest *request = [NSURLRequest requestWithURL:url];
//    
//    [NSURLConnection connectionWithRequest:request delegate:self];
//    
//    NSLog(@"urlString: %@", urlString);
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

@end
