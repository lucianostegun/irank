//
//  Event.m
//  iRank
//
//  Created by Luciano Stegun on 7/11/11.
//  Copyright 2011 __MyCompanyName__. All rights reserved.
//

#import "Ranking.h"

@implementation Ranking

@synthesize rankingId;
@synthesize rankingTypeId;
@synthesize gameStyleId;
@synthesize rankingName;
@synthesize players;
@synthesize events;
@synthesize rankingType;
@synthesize gameStyle;
@synthesize credit;
@synthesize startDate;
@synthesize finishDate;
@synthesize isPrivate;
@synthesize defaultBuyin;

-(void)save {
    
    rankingName  = [self.rankingName stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
    gameStyle    = [self.gameStyle stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
    startDate    = [self.startDate stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
    finishDate   = [self.finishDate stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
    isPrivate    = [self.isPrivate stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
    rankingType  = [self.rankingType stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
    defaultBuyin = [self.defaultBuyin stringByTrimmingCharactersInSet: [NSCharacterSet whitespaceAndNewlineCharacterSet]];
    
    rankingName  = [self.rankingName stringByReplacingOccurrencesOfString:@" " withString:@"+"];
    startDate    = [self.startDate stringByReplacingOccurrencesOfString:@"/" withString:@"-"];
    finishDate   = [self.finishDate stringByReplacingOccurrencesOfString:@"/" withString:@"-"];
    
    NSString *urlString = [NSString stringWithFormat:@"http://irank/index.php/ranking/saveMobile?rankingId=%i&rankingName=%@&gameStyle=%@&startDate=%@&finishDate=%@&isPrivate=%@&rankingType=%@&defaultBuyin=%@", rankingId, rankingName, gameStyle, startDate, finishDate, isPrivate, rankingType, defaultBuyin];
    
    NSURL *url = [NSURL URLWithString:urlString];
    NSURLRequest *request = [NSURLRequest requestWithURL:url];
    NSURLConnection *connection = [[NSURLConnection alloc] initWithRequest:request delegate:self];
    
    NSLog(@"url: %@", urlString);
}

- (void)connection: (NSURLConnection *)connection didReceiveResponse:(NSURLResponse *)response {
    
    NSLog(@"response: %@", response);
}

- (void)connection: (NSURLConnection *)connection didReceiveData:(NSData *)data {
    
    NSString *result = [[NSString alloc] initWithData:data encoding:NSASCIIStringEncoding];
    
    NSLog(@"result: %@", result);
    
    [result release];
}

- (void)connectionDidFinishLoading:(NSURLConnection *)connection {
    
    [connection release];
}

- (void) dealloc {
    
    [rankingName release];
    [rankingType release];
    [gameStyle release];
    [credit release];
    [startDate release];
    [finishDate release];
    [isPrivate release];
    [defaultBuyin release];
    [players release];
    [events release];
    [super dealloc];
}

@end
