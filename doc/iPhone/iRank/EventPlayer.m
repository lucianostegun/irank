//
//  EventPlayer.m
//  iRank
//
//  Created by Luciano Stegun on 01/05/2011.
//  Copyright (c) 2011 __MyCompanyName__. All rights reserved.
//

#import "EventPlayer.h"
#import "Player.h"
#import "Constants.h"
#import "iRankAppDelegate.h"

@implementation EventPlayer
@synthesize player;
@synthesize enabled;
@synthesize inviteStatus;
@synthesize eventId;



-(void)togglePresence:(NSString *)choice {
    
    int userSiteId = [(iRankAppDelegate *)[[UIApplication sharedApplication] delegate] userSiteId];
    
    NSString *urlString = [NSString stringWithFormat:@"http://%@/ios.php/event/togglePresence/eventId/%i/peopleId/%i/choice/%@/userSiteId/%i", serverAddress, player.playerId, eventId, choice, userSiteId];
    
    self.inviteStatus = choice;
    
    NSURL *url = [NSURL URLWithString:urlString];
    
    NSURLRequest *request = [NSURLRequest requestWithURL:url];
    
    [NSURLConnection connectionWithRequest:request delegate:self];
//    NSLog(@"urlString: %@", urlString);
}

- (void)connection: (NSURLConnection *)connection didReceiveResponse:(NSURLResponse *)response {
    
//    NSLog(@"didReceiveResponse");
//    [activityIndicator setHidden:YES];
}

- (void)connection: (NSURLConnection *)connection didReceiveData:(NSData *)data {
    
    NSLog(@"didReceiveData");
    
    NSString *result = [[NSString alloc] initWithData:data encoding:NSASCIIStringEncoding];
    
    NSLog(@"result: %@", result);
    [result release];
}

- (void)connectionDidFinishLoading:(NSURLConnection *)connection {
    
//    NSLog(@"connectionDidFinishLoading");
}

-(void) dealloc {
    
    [player release];
    [inviteStatus release];
    [super dealloc];
}

@end
